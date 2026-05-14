<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;

class ProductoController extends Controller
{
    // Lista todos los productos, agrupados por categoría
    public function index()
    {
        // with('productos') es eager loading — evita el problema N+1
        // (sin esto, haría 1 query por cada categoría, con esto hace solo 2 en total)
        $categorias = Categoria::with('productos')->get();

        return view('productos.index', compact('categorias'));
    }

    // Filtra productos de una categoría específica
    public function categoria(Categoria $categoria)
    {
        // Laravel hace la magia de buscar por ID automáticamente (Route Model Binding)
        $categoria->load('productos'); // carga los productos de esta categoría

        return view('productos.categoria', compact('categoria'));
    }
}