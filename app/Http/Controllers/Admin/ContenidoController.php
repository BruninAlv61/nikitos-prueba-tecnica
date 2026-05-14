<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class ContenidoController extends Controller
{
    /**
     * Listado de bloques de texto editables del sitio (páginas, secciones, etc.).
     */
    public function index(): View
    {
        return view('admin.contenido.index');
    }
}
