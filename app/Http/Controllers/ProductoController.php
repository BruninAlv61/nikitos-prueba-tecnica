<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;

class ProductoController extends Controller
{
    // Lista todos los productos, agrupados por categoría
    public function index()
    {
        $categorias = Categoria::all();

        return view('productos.index', compact('categorias'));
    }

    // Filtra productos de una categoría específica
    public function categoria(Categoria $categoria)
    {
        $categoria->load('productos');
        $categorias = Categoria::orderBy('id')->get();

        return view('productos.categoria', compact('categoria', 'categorias'));
    }

    public function show(Categoria $categoria, Producto $producto)
    {
        $productos = Producto::where('categoria_id', $categoria->id)->orderBy('id')->get();
        $index = $productos->search(fn ($p) => $p->id === $producto->id);

        $anterior = $index > 0 ? $productos[$index - 1] : null;
        $siguiente = $index < $productos->count() - 1 ? $productos[$index + 1] : null;

        $relacionados = Producto::where('categoria_id', $categoria->id)
            ->where('id', '!=', $producto->id)
            ->take(3)
            ->get();

        $categorias = Categoria::orderBy('id')->get();

        return view('productos.show', compact('categoria', 'producto', 'anterior', 'siguiente', 'relacionados', 'categorias'));
    }
}
