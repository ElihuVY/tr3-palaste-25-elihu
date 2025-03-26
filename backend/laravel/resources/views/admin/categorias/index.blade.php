{{-- admin/categorias/index.blade.php --}}
@extends('layouts.admin')

@section('content')
<div class="bg-white shadow-md rounded-lg">
    <div class="flex justify-between items-center p-6 border-b">
        <h2 class="text-2xl font-semibold text-gray-800">Categorías</h2>
        <a href="{{ route('admin.categorias.create') }}" 
           class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
            Nueva Categoría
        </a>
    </div>
    
    <table class="w-full">
        <thead>
            <tr class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                <th class="py-3 px-6 text-left">Nombre</th>
                <th class="py-3 px-6 text-center">Productos</th>
                <th class="py-3 px-6 text-right">Acciones</th>
            </tr>
        </thead>
        <tbody class="text-gray-600">
            @foreach($categorias as $categoria)
            <tr class="border-b border-gray-200 hover:bg-gray-100">
                <td class="py-3 px-6 text-left">
                    <div class="flex items-center">
                        <span>{{ $categoria->nombre }}</span>
                    </div>
                </td>
                <td class="py-3 px-6 text-center">
                    {{ $categoria->productos_count }}
                </td>
                <td class="py-3 px-6 text-right">
                    <div class="flex justify-end space-x-2">
                        <a href="{{ route('admin.categorias.edit', $categoria) }}" 
                           class="text-blue-500 hover:text-blue-700">
                            Editar
                        </a>
                        <form action="{{ route('admin.categorias.destroy', $categoria) }}" method="POST" 
                              onsubmit="return confirm('¿Estás seguro de eliminar esta categoría?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700">
                                Eliminar
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="p-6">
        {{ $categorias->links() }}
    </div>
</div>
@endsection

{{-- admin/categorias/create.blade.php --}}
@extends('layouts.admin')

@section('content')
<div class="max-w-md mx-auto bg-white shadow-md rounded-lg p-8">
    <h2 class="text-2xl font-semibold text-center mb-6">Crear Categoría</h2>
    
    <form action="{{ route('admin.categorias.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="nombre" class="block text-gray-700 font-bold mb-2">Nombre</label>
            <input type="text" name="nombre" id="nombre" 
                   class="w-full px-3 py-2 border rounded-lg @error('nombre') border-red-500 @enderror"
                   value="{{ old('nombre') }}" required>
            @error('nombre')
                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="descripcion" class="block text-gray-700 font-bold mb-2">Descripción (Opcional)</label>
            <textarea name="descripcion" id="descripcion" 
                      class="w-full px-3 py-2 border rounded-lg @error('descripcion') border-red-500 @enderror">{{ old('descripcion') }}</textarea>
            @error('descripcion')
                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-between items-center">
            <a href="{{ route('admin.categorias.index') }}" 
               class="text-gray-600 hover:text-gray-800">Cancelar</a>
            <button type="submit" 
                    class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
                Crear Categoría
            </button>
        </div>
    </form>
</div>
@endsection

{{-- admin/categorias/edit.blade.php --}}
@extends('layouts.admin')

@section('content')
<div class="max-w-md mx-auto bg-white shadow-md rounded-lg p-8">
    <h2 class="text-2xl font-semibold text-center mb-6">Editar Categoría</h2>
    
    <form action="{{ route('admin.categorias.update', $categoria) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="nombre" class="block text-gray-700 font-bold mb-2">Nombre</label>
            <input type="text" name="nombre" id="nombre" 
                   class="w-full px-3 py-2 border rounded-lg @error('nombre') border-red-500 @enderror"
                   value="{{ old('nombre', $categoria->nombre) }}" required>
            @error('nombre')
                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="descripcion" class="block text-gray-700 font-bold mb-2">Descripción (Opcional)</label>
            <textarea name="descripcion" id="descripcion" 
                      class="w-full px-3 py-2 border rounded-lg @error('descripcion') border-red-500 @enderror">{{ old('descripcion', $categoria->descripcion) }}</textarea>
            @error('descripcion')
                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-between items-center">
            <a href="{{ route('admin.categorias.index') }}" 
               class="text-gray-600 hover:text-gray-800">Cancelar</a>
            <button type="submit" 
                    class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
                Actualizar Categoría
            </button>
        </div>
    </form>
</div>
@endsection