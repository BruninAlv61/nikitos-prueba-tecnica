<?php

use App\Http\Controllers\ContactoController;
use App\Http\Controllers\PaginaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecetaController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PaginaController::class, 'home'])->name('home');
Route::get('/productos', [ProductoController::class, 'index'])->name('productos');
Route::get('/productos/{categoria}', [ProductoController::class, 'categoria'])->name('productos.categoria');
Route::get('/productos/{categoria}/{producto}', [ProductoController::class, 'show'])->name('productos.show');
Route::get('/nosotros', [PaginaController::class, 'nosotros'])->name('nosotros');
Route::get('/donde-comprar', [PaginaController::class, 'dondeComprar'])->name('donde-comprar');
Route::get('/recetas', [RecetaController::class, 'index'])->name('recetas');
Route::get('/recetas/{receta}', [RecetaController::class, 'show'])->name('recetas.show');
Route::get('/rse', [PaginaController::class, 'rse'])->name('rse');
Route::get('/politicas-de-calidad', [PaginaController::class, 'politicasCalidad'])->name('politicas-calidad');
Route::get('/contacto', [ContactoController::class, 'index'])->name('contacto');
Route::post('/contacto', [ContactoController::class, 'store'])->name('contacto.store');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return redirect()->route('admin.productos.index');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
