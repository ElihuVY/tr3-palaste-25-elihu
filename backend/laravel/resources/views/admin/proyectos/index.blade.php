{{-- admin/proyectos/index.blade.php --}}
@extends('layouts.admin')

@section('content')
<div class="bg-white shadow-md rounded-lg">
    <div class="flex justify-between items-center p-6 border-b">
        <h2 class="text-2xl font-semibold text-gray-800">Peticiones de Proyecto</h2>
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
            @foreach($peticiones as $peticion)
            <tr class="border-b border-gray-200 hover:bg-gray-100">
                <td class="py-3 px-6 text-left">{{ $peticion->id }}</td>
                <td class="py-3 px-6 text-left">{{ $peticion->user->name }}</td>
                <td class="py-3 px-6 text-center">{{ $peticion->created_at->format('d/m/Y H:i') }}</td>
                <td class="py-3 px-6 text-center">
                    <span class="
                        px-3 py-1 rounded-full text-xs 
                        {{ $peticion->estado == 'pendiente' ? 'bg-yellow-100 text-yellow-600' : '' }}
                        {{ $peticion->estado == 'en proceso' ? 'bg-blue-100 text-blue-600' : '' }}
                        {{ $peticion->estado == 'completado' ? 'bg-green-100 text-green-600' : '' }}
                    ">
                        {{ ucfirst($peticion->estado) }}
                    </span>
                </td>
                <td class="py-3 px-6 text-right">
                    <a href="{{ route('admin.proyectos.show', $peticion) }}" 
                       class="text-blue-500 hover:text-blue-700">
                        Detalles
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="p-6">
        {{ $peticiones->links() }}
    </div>
</div>
@endsection

{{-- admin/proyectos/show.blade.php --}}
@extends('layouts.admin')

@section('content')
<div class="bg-white shadow-md rounded-lg">
    <div class="p-6 border-b flex justify-between items-center">
        <h2 class="text-2xl font-semibold text-gray-800">Detalles de Proyecto #{{ $peticion->id }}</h2>
        <form action="{{ route('admin.proyectos.update', $peticion) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="flex items-center space-x-4">
                <select name="estado" 
                        class="border rounded px-3 py-2 mr-2"
                        onchange="this.form.submit()">
                    @php
                        $estados = ['pendiente', 'en proceso', 'completado']
                    @endphp
                    @foreach($estados as $estado)
                        <option value="{{ $estado }}" 
                                {{ $peticion->estado == $estado ? 'selected' : '' }}>
                            {{ ucfirst($estado) }}
                        </option>
                    @endforeach
                </select>
            </div>
        </form>
    </div>

    <div class="grid md:grid-cols-2 gap-6 p-6">
        <div>
            <h3 class="text-xl font-semibold mb-4">Información del Proyecto</h3>
            <div class="space-y-2">
                <p><strong>Usuario:</strong> {{ $peticion->user->name }}</p>
                <p><strong>Email:</strong> {{ $peticion->user->email }}</p>
                <p><strong>Fecha:</strong> {{ $peticion->created_at->format('d/m/Y H:i') }}</p>
                <p><strong>Estado:</strong> 
                    <span class="
                        px-3 py-1 rounded-full text-xs 
                        {{ $peticion->estado == 'pendiente' ? 'bg-yellow-100 text-yellow-600' : '' }}
                        {{ $peticion->estado == 'en proceso' ? 'bg-blue-100 text-blue-600' : '' }}
                        {{ $peticion->estado == 'completado' ? 'bg-green-100 text-green-600' : '' }}
                    ">
                        {{ ucfirst($peticion->estado) }}
                    </span>
                </p>
            </div>
        </div>

        <div>
            <h3 class="text-xl font-semibold mb-4">Detalles del Proyecto</h3>
            <div class="space-y-2">
                <p><strong>Descripción:</strong> {{ $peticion->descripcion }}</p>
                
                @if($peticion->detalle_mejorado)
                <p><strong>Detalle Mejorado:</strong> {{ $peticion->detalle_mejorado }}</p>
                @endif

                <h4 class="text-lg font-semibold mt-4">Archivos Adjuntos</h4>
                @if($peticion->archivos->count() > 0)
                    <div class="space-y-2">
                        @foreach($peticion->archivos as $archivo)
                            <div class="flex items-center justify-between border-b pb-2">
                                <p>{{ $archivo->nombre_original }}</p>
                                <a href="{{ Storage::url($archivo->ruta) }}" 
                                   target="_blank" 
                                   class="text-blue-500 hover:text-blue-700">
                                    Descargar
                                </a>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500">No hay archivos adjuntos</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection