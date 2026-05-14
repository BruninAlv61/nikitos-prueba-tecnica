<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contacto;

class ContactoController extends Controller
{
    public function index()
    {
        $contactos = Contacto::orderBy('created_at', 'desc')->get();

        return view('admin.contactos.index', compact('contactos'));
    }

    public function show(Contacto $contacto)
    {
        return view('admin.contactos.show', compact('contacto'));
    }

    public function destroy(Contacto $contacto)
    {
        $contacto->delete();

        return redirect()->route('admin.contactos.index')->with('success', 'Mensaje eliminado correctamente.');
    }
}
