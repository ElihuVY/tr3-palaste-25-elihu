<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index()
    {
        $categorias = Categoria::withCount('productos')->paginate(10);
        return view('admin.categorias.index', compact('categorias'));
    }

    public function create()
    {
        return view('admin.categorias.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|unique:categorias|max:255',
            'descripcion' => 'nullable|max:500'
        ]);

        Categoria::create($validatedData);

        return redirect()->route('admin.categorias.index')
            ->with('success', 'Categoría creada exitosamente.');
    }

    public function edit(Categoria $categoria)
    {
        return view('admin.categorias.edit', compact('categoria'));
    }

    public function update(Request $request, Categoria $categoria)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|max:255|unique:categorias,nombre,' . $categoria->id,
            'descripcion' => 'nullable|max:500'
        ]);

        $categoria->update($validatedData);

        return redirect()->route('admin.categorias.index')
            ->with('success', 'Categoría actualizada exitosamente.');
    }

    public function destroy(Categoria $categoria)
    {
        if ($categoria->productos()->count() > 0) {
            return redirect()->back()
                ->with('error', 'No se puede eliminar la categoría porque tiene productos asociados.');
        }

        $categoria->delete();

        return redirect()->route('admin.categorias.index')
            ->with('success', 'Categoría eliminada exitosamente.');
    }
}
