<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactoRequest;
use App\Models\Contacto;

class ContactoController extends Controller
{
    public function index()
    {
        return view('contacto');
    }

    public function store(StoreContactoRequest $request)
    {
        $data = collect($request->validated())->except('cv')->all();

        if ($request->hasFile('cv')) {
            $data['cv'] = $request->file('cv')->store('cvs', 'public');
        }

        Contacto::create($data);

        return back()->with('success', '¡Consulta enviada correctamente!');
    }
}
