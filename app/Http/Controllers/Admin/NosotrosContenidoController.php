<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateNosotrosContenidoRequest;
use App\Models\NosotrosContenido;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class NosotrosContenidoController extends Controller
{
    public function edit(): View
    {
        $contenido = NosotrosContenido::registro();

        return view('admin.nosotros.edit', compact('contenido'));
    }

    public function update(UpdateNosotrosContenidoRequest $request): RedirectResponse
    {
        $contenido = NosotrosContenido::registro();

        $contenido->update($request->validated());

        return redirect()
            ->route('admin.nosotros.edit')
            ->with('success', 'Contenido de Nosotros actualizado correctamente.');
    }
}
