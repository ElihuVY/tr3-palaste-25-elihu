<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\PeticionProyecto;
use Illuminate\Support\Facades\Auth;

class PerfilController extends Controller
{
    public function misPedidosYPeticiones()
    {
        $user = Auth::user();

        // Obtener pedidos y peticiones del usuario autenticado
        $pedidos = Pedido::where('user_id', $user->id)->with('productos')->get();
        $peticiones = PeticionProyecto::where('user_id', $user->id)->with('archivos')->get();

        return response()->json([
            'pedidos' => $pedidos,
            'peticiones' => $peticiones
        ]);
    }
}
