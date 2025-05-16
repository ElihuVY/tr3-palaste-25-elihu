<?php

namespace App\Http\Controllers;

use App\Models\ProjectRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Mail\ProjectRequestMail;
use Illuminate\Support\Facades\Mail;

class ProjectRequestController extends Controller
{
    public function store(Request $request)
    {
        // Validación de datos básicos
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string|max:255',
            'project_type' => 'required|in:stairs,railings,doors,other',
            'description' => 'required|string',
            'budget' => 'nullable|string|max:50',
            'timeline' => 'nullable|string|max:50',
            'files' => 'nullable|array|max:5',
            'files.*' => 'file|max:10240', // 10MB
            'stairs' => 'nullable|json',
            'railings' => 'nullable|json',
            'doors' => 'nullable|json',
            'other' => 'nullable|json',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        // procesar archivos
        $filesPaths = [];
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $path = $file->store('project_requests', 'public');
                $filesPaths[] = $path;
            }
        }

        // decodificar detalles específicos
        $details = [];
        if ($request->has($request->project_type)) {
            $details = json_decode($request->input($request->project_type), true);
        }

        // crear solicitud de proyecto
        $projectRequest = ProjectRequest::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'project_type' => $request->project_type,
            'description' => $request->description,
            'budget' => $request->budget,
            'timeline' => $request->timeline,
            'files' => $filesPaths,
            $request->project_type . '_details' => $details,
            'user_id' => auth()->id()
        ]);

        try {
            Mail::to('elihuvaldelomar26@gmail.com')->send(new ProjectRequestMail($projectRequest));
        } catch (\Exception $e) {
            \Log::error('Error enviando email: ' . $e->getMessage());
            // El proyecto se creó, pero falló el envío del correo
            // Podemos continuar sin error fatal
        }

        return response()->json([
            'message' => 'Solicitud de proyecto creada exitosamente',
            'data' => $projectRequest
        ], 201);
    }

    public function getProjectTypes()
    {
        //peticion donde pudo añadir tipos de proyecto o quitar
        return response()->json([
            'project_types' => [
                ['value' => 'stairs', 'label' => 'Escaleras', 'icon' => '📶'],
                ['value' => 'railings', 'label' => 'Barandillas', 'icon' => '🚧'],
                ['value' => 'doors', 'label' => 'Puertas', 'icon' => '🚪'],
                ['value' => 'other', 'label' => 'Otro proyecto', 'icon' => '🔩']
            ]
        ]);
    }
}
