{{-- admin/productos/index.blade.php --}}
@extends('layouts.admin')

@section('content')
<div class="bg-white shadow-md rounded-lg">
    <div class="flex justify-between items-center p-6 border-b">
        <h2 class="text-2xl font-semibold text-gray-800">Productos</h2>
        <a href="{{ route('admin.productos.create') }}" 
           class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
            Nuevo Producto
        </a>
    </div>
    
    <table class="w-full">
        <thead>
            <tr class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                <th class="py-3 px-6 text-left">Imagen</th>
                <th class="py-3 px-6 text-left">Nombre</th>
                <th class="py-3 px-6 text-center">Categoría</th>
                <th class="py-3 px-6 text-center">Precio</th>
                <th class="py-3 px-6 text-center">Stock</th>
                <th class="py-3 px-6 text-right">Acciones</th>
            </tr>
        </thead>
        <tbody class="text-gray-600">
            @foreach($productos as $producto)
            <tr class="border-b border-gray-200 hover:bg-gray-100">
                <td class="py-3 px-6">
                    <img src="{{ $producto->imagen }}" 
                         alt="{{ $producto->nombre }}" 
                         class="w-16 h-16 object-cover rounded">
                </td>
                <td class="py-3 px-6">{{ $producto->nombre }}</td>
                <td class="py-3 px-6 text-center">{{ $producto->categoria->nombre }}</td>
                <td class="py-3 px-6 text-center">${{ number_format($producto->precio, 2) }}</td>
                <td class="py-3 px-6 text-center">{{ $producto->stock }}</td>
                <td class="py-3 px-6 text-right">
                    <div class="flex justify-end space-x-2">
                        <a href="{{ route('admin.productos.edit', $producto) }}" 
                           class="text-blue-500 hover:text-blue-700">
                            Editar
                        </a>
                        <form action="{{ route('admin.productos.destroy', $producto) }}" method="POST" 
                              onsubmit="return confirm('¿Estás seguro de eliminar este producto?')">
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
        {{ $productos->links() }}
    </div>
</div>
@endsection

{{-- admin/productos/create.blade.php --}}
@extends('layouts.admin')

@section('content')
<div class="max-w-md mx-auto bg-white shadow-md rounded-lg p-8">
    <h2 class="text-2xl font-semibold text-center mb-6">Crear Producto</h2>
    
    <form action="{{ route('admin.productos.store') }}" method="POST" enctype="multipart/form-data">
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
            <label for="descripcion" class="block text-gray-700 font-bold mb-2">Descripción</label>
            <textarea name="descripcion" id="descripcion" 
                      class="w-full px-3 py-2 border rounded-lg @error('descripcion') border-red-500 @enderror">{{ old('descripcion') }}</textarea>
            @error('descripcion')
                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="categoria_id" class="block text-gray-700 font-bold mb-2">Categoría</label>
            <select name="categoria_id" id="categoria_id" 
                    class="w-full px-3 py-2 border rounded-lg @error('categoria_id') border-red-500 @enderror" required>
                <option value="">Seleccione una categoría</option>
                @foreach($categorias as $categoria)
                    <option value="{{ $categoria->id }}" 
                            {{ old('categoria_id') == $categoria->id ? 'selected' : '' }}>
                        {{ $categoria->nombre }}
                    </option>
                @endforeach
            </select>
            @error('categoria_id')
                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="imagen" class="block text-gray-700 font-bold mb-2">Imagen</label>
            <input type="file" name="imagen" id="imagen" 
                   class="w-full px-3 py-2 border rounded-lg @error('imagen') border-red-500 @enderror" 
                   accept="image/*" required>
            @error('imagen')
                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex mb-4 space-x-4">
            <div class="flex-1">
                <label for="precio" class="block text-gray-700 font-bold mb-2">Precio</label>
                <input type="number" name="precio" id="precio" step="0.01" min="0"
                       class="w-full px-3 py-2 border rounded-lg @error('precio') border-red-500 @enderror"
                       value="{{ old('precio') }}" required>
                @error('precio')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex-1">
                <label for="stock" class="block text-gray-700 font-bold mb-2">Stock</label>
                <input type="number" name="stock" id="stock" min="0"
                       class="w-full px-3 py-2 border rounded-lg @error('stock') border-red-500 @enderror"
                       value="{{ old('stock') }}" required>
                @error('stock')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="flex justify-between items-center">
            <a href="{{ route('admin.productos.index') }}" 
               class="text-gray-600 hover:text-gray-800">Cancelar</a>
            <button type="submit" 
                    class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
                Crear Producto
            </button>
        </div>
    </form>
</div>
@endsection

{{-- admin/productos/edit.blade.php (similar to create, with pre-filled values) --}}