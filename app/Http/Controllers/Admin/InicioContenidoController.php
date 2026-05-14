<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateInicioContenidoRequest;
use App\Models\InicioContenido;
use App\Services\Images\OptimizedPublicImage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\UploadedFile;
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

        if ($request->hasFile('hero_banner')) {
            if ($contenido->hero_banner_path) {
                Storage::disk('public')->delete($contenido->hero_banner_path);
            }
            $file = $request->file('hero_banner');
            $datos['hero_banner_path'] = self::storeHeroBanner($file);
        } elseif ($request->boolean('hero_banner_eliminar')) {
            if ($contenido->hero_banner_path) {
                Storage::disk('public')->delete($contenido->hero_banner_path);
            }
            $datos['hero_banner_path'] = null;
        }

        $contenido->update($datos);

        return redirect()
            ->route('admin.inicio-contenido.edit')
            ->with('success', 'Contenido de la página de Inicio actualizado correctamente.');
    }

    private static function storeHeroBanner(UploadedFile $file): string
    {
        $mime = (string) ($file->getMimeType() ?? '');
        $ext = strtolower($file->getClientOriginalExtension());
        if ($mime === 'video/mp4' || $ext === 'mp4') {
            return $file->store('hero-banner', 'public');
        }

        return OptimizedPublicImage::store($file, 'hero-banner');
    }
}
