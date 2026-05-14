<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Contacto;

class PaginaController extends Controller
{
    public function home()
    {
        // Traemos las categorías para mostrar en el home
        $categorias = Categoria::all();

        // En Laravel, compact() es la forma corta de ['categorias' => $categorias]
        return view('home', compact('categorias'));
    }

    public function nosotros()
    {
        return view('nosotros');
    }

    public function dondeComprar()
    {
        return view('donde-comprar');
    }

    public function contacto()
    {
        return view('contacto');
    }
}