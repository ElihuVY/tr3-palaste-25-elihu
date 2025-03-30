<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\ProjectRequest;
use Illuminate\Support\Facades\Auth;

class PerfilController extends Controller
{
    public function misPedidosYPeticiones()
{
    $user = Auth::user();
    
    // 1. Busca proyectos por email EXACTO (incluyendo mayúsculas/minúsculas)
    $peticiones = ProjectRequest::where('email', 'like', $user->email)
                              ->orWhere('user_id', $user->id)
                              ->orderBy('created_at', 'desc')
                              ->get();

    // 2. Actualiza user_id en proyectos antiguos (sin user_id pero con email coincidente)
    ProjectRequest::where('email', 'like', $user->email)
                ->whereNull('user_id')
                ->update(['user_id' => $user->id]);

    return response()->json([
        'peticiones' => $peticiones,
        'message' => 'Proyectos cargados correctamente'
        
    ]);
}
    private function vincularPeticionesAntiguas($user)
    {
        // Actualizar peticiones con matching email pero sin user_id
        ProjectRequest::where('email', $user->email)
                    ->whereNull('user_id')
                    ->update(['user_id' => $user->id]);
    }
}