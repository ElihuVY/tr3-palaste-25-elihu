<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PeticionProyecto;
use Illuminate\Http\Request;

class PeticionProyectoController extends Controller
{
    public function index()
    {
        $peticiones = PeticionProyecto::with('user')->paginate(10);
        return view('admin.proyectos.index', compact('peticiones'));
    }

    public function show(PeticionProyecto $peticion)
    {
        $peticion->load('user', 'archivos');
        return view('admin.proyectos.show', compact('peticion'));
    }

    public function update(Request $request, PeticionProyecto $peticion)
    {
        $validatedData = $request->validate([
            'estado' => 'required|in:pendiente,en proceso,completado',
            'detalle_mejorado' => 'nullable|string'
        ]);

        $peticion->update($validatedData);

        return redirect()->route('admin.proyectos.show', $peticion)
            ->with('success', 'Petición de proyecto actualizada.');
    }
}
