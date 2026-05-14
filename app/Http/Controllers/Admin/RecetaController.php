<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRecetaRequest;
use App\Http\Requests\UpdateRecetaRequest;
use App\Models\Receta;
use App\Services\Images\OptimizedPublicImage;
use Illuminate\Support\Facades\Storage;

class RecetaController extends Controller
{
    public function index()
    {
        $recetas = Receta::latest()->get();

        return view('admin.recetas.index', compact('recetas'));
    }

    public function create()
    {
        return view('admin.recetas.create');
    }

    public function store(StoreRecetaRequest $request)
    {
        $data = $request->safe()->only(['titulo', 'tiempo_preparacion', 'porciones']);
        $data['ingredientes'] = array_values(array_filter(
            $request->input('ingredientes', []),
            static fn ($v): bool => is_string($v) && trim($v) !== ''
        ));
        $data['pasos'] = array_values(array_filter(
            $request->input('pasos', []),
            static fn ($v): bool => is_string($v) && trim($v) !== ''
        ));

        if ($request->hasFile('imagen')) {
            $data['imagen'] = OptimizedPublicImage::store($request->file('imagen'), 'recetas');
        }

        Receta::create($data);

        return redirect()->route('admin.recetas.index')->with('success', 'Receta creada correctamente.');
    }

    public function edit(Receta $receta)
    {
        return view('admin.recetas.edit', compact('receta'));
    }

    public function update(UpdateRecetaRequest $request, Receta $receta)
    {
        $receta->fill($request->safe()->only(['titulo', 'tiempo_preparacion', 'porciones']));
        $receta->ingredientes = array_values(array_filter(
            $request->input('ingredientes', []),
            static fn ($v): bool => is_string($v) && trim($v) !== ''
        ));
        $receta->pasos = array_values(array_filter(
            $request->input('pasos', []),
            static fn ($v): bool => is_string($v) && trim($v) !== ''
        ));

        if ($request->hasFile('imagen')) {
            if ($receta->imagen && ! str_starts_with($receta->imagen, 'images/')) {
                Storage::disk('public')->delete($receta->imagen);
            }
            $receta->imagen = OptimizedPublicImage::store($request->file('imagen'), 'recetas');
        }

        $receta->save();

        return redirect()->route('admin.recetas.index')->with('success', 'Receta actualizada correctamente.');
    }

    public function destroy(Receta $receta)
    {
        if ($receta->imagen && ! str_starts_with($receta->imagen, 'images/')) {
            Storage::disk('public')->delete($receta->imagen);
        }

        $receta->delete();

        return redirect()->route('admin.recetas.index')->with('success', 'Receta eliminada correctamente.');
    }
}
