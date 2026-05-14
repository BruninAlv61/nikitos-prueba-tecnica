<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoriaRequest;
use App\Http\Requests\UpdateCategoriaRequest;
use App\Models\Categoria;
use Illuminate\Support\Facades\Storage;

class CategoriaController extends Controller
{
    public function index()
    {
        $categorias = Categoria::withCount('productos')->get();

        return view('admin.categorias.index', compact('categorias'));
    }

    public function create()
    {
        return view('admin.categorias.create');
    }

    public function store(StoreCategoriaRequest $request)
    {
        $data = $request->safe()->only(['nombre', 'color']);

        if ($request->hasFile('imagen')) {
            $data['imagen'] = $request->file('imagen')->store('categorias', 'public');
        }

        if ($request->hasFile('catalogo')) {
            $data['catalogo'] = $request->file('catalogo')->store('catalogos', 'public');
        }

        Categoria::create($data);

        return redirect()->route('admin.categorias.index')->with('success', 'Categoría creada correctamente.');
    }

    public function edit(Categoria $categoria)
    {
        return view('admin.categorias.edit', compact('categoria'));
    }

    public function update(UpdateCategoriaRequest $request, Categoria $categoria)
    {
        $data = $request->safe()->only(['nombre', 'color']);

        if ($request->hasFile('imagen')) {
            if ($categoria->imagen) {
                Storage::disk('public')->delete($categoria->imagen);
            }
            $data['imagen'] = $request->file('imagen')->store('categorias', 'public');
        }

        if ($request->hasFile('catalogo')) {
            if ($categoria->catalogo) {
                Storage::disk('public')->delete($categoria->catalogo);
            }
            $data['catalogo'] = $request->file('catalogo')->store('catalogos', 'public');
        }

        $categoria->update($data);

        return redirect()->route('admin.categorias.index')->with('success', 'Categoría actualizada correctamente.');
    }

    public function destroy(Categoria $categoria)
    {
        if ($categoria->imagen) {
            Storage::disk('public')->delete($categoria->imagen);
        }
        if ($categoria->catalogo) {
            Storage::disk('public')->delete($categoria->catalogo);
        }

        $categoria->delete();

        return redirect()->route('admin.categorias.index')->with('success', 'Categoría eliminada correctamente.');
    }
}
