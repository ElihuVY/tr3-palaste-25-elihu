<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::with('categoria')->paginate(10);
        return view('admin.productos.index', compact('productos'));
    }

    public function create()
    {
        $categorias = Categoria::all();
        return view('admin.productos.create', compact('categorias'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|max:255',
            'descripcion' => 'nullable',
            'imagen' => 'required|image|max:2048',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'categoria_id' => 'required|exists:categorias,id'
        ]);

        $imagePath = $request->file('imagen')->store('productos', 'public');
        $validatedData['imagen'] = Storage::url($imagePath);

        Producto::create($validatedData);

        return redirect()->route('admin.productos.index')
            ->with('success', 'Producto creado exitosamente.');
    }

    public function edit(Producto $producto)
    {
        $categorias = Categoria::all();
        return view('admin.productos.edit', compact('producto', 'categorias'));
    }

    public function update(Request $request, Producto $producto)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|max:255',
            'descripcion' => 'nullable',
            'imagen' => 'sometimes|image|max:2048',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'categoria_id' => 'required|exists:categorias,id'
        ]);

        if ($request->hasFile('imagen')) {
            if ($producto->imagen) {
                Storage::delete(str_replace('/storage/', '', $producto->imagen));
            }

            $imagePath = $request->file('imagen')->store('productos', 'public');
            $validatedData['imagen'] = Storage::url($imagePath);
        }

        $producto->update($validatedData);

        return redirect()->route('admin.productos.index')
            ->with('success', 'Producto actualizado exitosamente.');
    }

    public function destroy(Producto $producto)
    {
        if ($producto->imagen) {
            Storage::delete(str_replace('/storage/', '', $producto->imagen));
        }

        $producto->delete();

        return redirect()->route('admin.productos.index')
            ->with('success', 'Producto eliminado exitosamente.');
    }
}
