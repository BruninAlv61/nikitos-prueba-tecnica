<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateInicioContenidoRequest;
use App\Models\InicioContenido;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class InicioContenidoController extends Controller
{
    public function edit(): View
    {
        $contenido = InicioContenido::registro();

        return view('admin.inicio-contenido.edit', compact('contenido'));
    }

    public function update(UpdateInicioContenidoRequest $request): RedirectResponse
    {
        $contenido = InicioContenido::registro();

        $datos = $request->safe()->only(['hero_titulo', 'hero_texto', 'about_us_texto']);

        if ($request->hasFile('hero_catalogo_pdf')) {
            if ($contenido->hero_catalogo_pdf) {
                Storage::disk('public')->delete($contenido->hero_catalogo_pdf);
            }
            $datos['hero_catalogo_pdf'] = $request->file('hero_catalogo_pdf')->store('catalogos', 'public');
        }

        $contenido->update($datos);

        return redirect()
            ->route('admin.inicio-contenido.edit')
            ->with('success', 'Contenido de la página de Inicio actualizado correctamente.');
    }
}
