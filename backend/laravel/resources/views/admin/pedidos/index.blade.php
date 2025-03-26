{{-- admin/pedidos/index.blade.php --}}
@extends('layouts.admin')

@section('content')
<div class="bg-white shadow-md rounded-lg">
    <div class="flex justify-between items-center p-6 border-b">
        <h2 class="text-2xl font-semibold text-gray-800">Pedidos</h2>
    </div>
    
    <table class="w-full">
        <thead>
            <tr class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                <th class="py-3 px-6 text-left">ID</th>
                <th class="py-3 px-6 text-left">Usuario</th>
                <th class="py-3 px-6 text-center">Fecha</th>
                <th class="py-3 px-6 text-center">Estado</th>
                <th class="py-3 px-6 text-right">Acciones</th>
            </tr>
        </thead>
        <tbody class="text-gray-600">
            @foreach($pedidos as $pedido)
            <tr class="border-b border-gray-200 hover:bg-gray-100">
                <td class="py-3 px-6 text-left">{{ $pedido->id }}</td>
                <td class="py-3 px-6 text-left">{{ $pedido->user->name }}</td>
                <td class="py-3 px-6 text-center">{{ $pedido->created_at->format('d/m/Y H:i') }}</td>
                <td class="py-3 px-6 text-center">
                    <span class="
                        px-3 py-1 rounded-full text-xs 
                        {{ $pedido->estado == 'pendiente' ? 'bg-yellow-100 text-yellow-600' : '' }}
                        {{ $pedido->estado == 'procesando' ? 'bg-blue-100 text-blue-600' : '' }}
                        {{ $pedido->estado == 'enviado' ? 'bg-green-100 text-green-600' : '' }}
                        {{ $pedido->estado == 'completado' ? 'bg-green-200 text-green-800' : '' }}
                        {{ $pedido->estado == 'cancelado' ? 'bg-red-100 text-red-600' : '' }}
                    ">
                        {{ ucfirst($pedido->estado) }}
                    </span>
                </td>
                <td class="py-3 px-6 text-right">
                    <a href="{{ route('admin.pedidos.show', $pedido) }}" 
                       class="text-blue-500 hover:text-blue-700">
                        Detalles
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="p-6">
        {{ $pedidos->links() }}
    </div>
</div>
@endsection

{{-- admin/pedidos/show.blade.php --}}
@extends('layouts.admin')

@section('content')
<div class="bg-white shadow-md rounded-lg">
    <div class="p-6 border-b flex justify-between items-center">
        <h2 class="text-2xl font-semibold text-gray-800">Detalles del Pedido #{{ $pedido->id }}</h2>
        <form action="{{ route('admin.pedidos.update', $pedido) }}" method="POST">
            @csrf
            @method('PUT')
            <select name="estado" 
                    class="border rounded px-3 py-2 mr-2"
                    onchange="this.form.submit()">
                @php
                    $estados = ['pendiente', 'procesando', 'enviado', 'completado', 'cancelado']
                @endphp
                @foreach($estados as $estado)
                    <option value="{{ $estado }}" 
                            {{ $pedido->estado == $estado ? 'selected' : '' }}>
                        {{ ucfirst($estado) }}
                    </option>
                @endforeach
            </select>
        </form>
    </div>

    <div class="grid md:grid-cols-2 gap-6 p-6">
        <div>
            <h3 class="text-xl font-semibold mb-4">Información del Pedido</h3>
            <div class="space-y-2">
                <p><strong>Usuario:</strong> {{ $pedido->user->name }}</p>
                <p><strong>Email:</strong> {{ $pedido->user->email }}</p>
                <p><strong>Fecha:</strong> {{ $pedido->created_at->format('d/m/Y H:i') }}</p>
                <p><strong>Estado:</strong> 
                    <span class="
                        px-3 py-1 rounded-full text-xs 
                        {{ $pedido->estado == 'pendiente' ? 'bg-yellow-100 text-yellow-600' : '' }}
                        {{ $pedido->estado == 'procesando' ? 'bg-blue-100 text-blue-600' : '' }}
                        {{ $pedido->estado == 'enviado' ? 'bg-green-100 text-green-600' : '' }}
                        {{ $pedido->estado == 'completado' ? 'bg-green-200 text-green-800' : '' }}
                        {{ $pedido->estado == 'cancelado' ? 'bg-red-100 text-red-600' : '' }}
                    ">
                        {{ ucfirst($pedido->estado) }}
                    </span>
                </p>
            </div>
        </div>

        <div>
            <h3 class="text-xl font-semibold mb-4">Productos</h3>
            <div class="space-y-2">
                @foreach($pedido->productos as $producto)
                    <div class="flex justify-between items-center border-b pb-2">
                        <div class="flex items-center">
                            <img src="{{ $producto->imagen }}" 
                                 alt="{{ $producto->nombre }}" 
                                 class="w-12 h-12 object-cover rounded mr-4">
                            <div>
                                <p>{{ $producto->nombre }}</p>
                                <p class="text-sm text-gray-500">
                                    ${{ number_format($producto->pivot->precio, 2) }} 
                                    x {{ $producto->pivot->cantidad }}
                                </p>
                            </div>
                        </div>
                        <p class="font-semibold">
                            ${{ number_format($producto->pivot->precio * $producto->pivot->cantidad, 2) }}
                        </p>
                    </div>
                @endforeach
                <div class="flex justify-between font-bold mt-4">
                    <p>Total:</p>
                    <p>
                        ${{ number_format($pedido->productos->sum(function($producto) {
                            return $producto->pivot->precio * $producto->pivot->cantidad;
                        }), 2) }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection