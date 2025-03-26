<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Pedido;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function index()
    {
        $pedidos = Pedido::with('user')->paginate(10);
        return view('admin.pedidos.index', compact('pedidos'));
    }

    public function show(Pedido $pedido)
    {
        $pedido->load('user', 'productos');
        return view('admin.pedidos.show', compact('pedido'));
    }

    public function update(Request $request, Pedido $pedido)
    {
        $validatedData = $request->validate([
            'estado' => 'required|in:pendiente,procesando,enviado,completado,cancelado'
        ]);

        $pedido->update($validatedData);

        return redirect()->route('admin.pedidos.show', $pedido)
            ->with('success', 'Estado del pedido actualizado.');
    }
}
