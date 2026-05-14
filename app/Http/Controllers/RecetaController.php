<?php

namespace App\Http\Controllers;

use App\Models\Receta;

class RecetaController extends Controller
{
    public function index()
    {
        $recetas = Receta::latest()->get();

        return view('recetas', compact('recetas'));
    }

    public function show(Receta $receta)
    {
        return view('recetas.show', compact('receta'));
    }
}
