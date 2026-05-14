<?php

use App\Http\Controllers\Admin\CategoriaController as AdminCategoriaController;
use App\Http\Controllers\Admin\ContenidoController as AdminContenidoController;
use App\Http\Controllers\Admin\InicioContenidoController;
use App\Http\Controllers\Admin\NosotrosContenidoController;
use App\Http\Controllers\Admin\ProductoController as AdminProductoController;
use App\Http\Controllers\Admin\RecetaController as AdminRecetaController;
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

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::resource('productos', AdminProductoController::class)->names('admin.productos');
    Route::resource('categorias', AdminCategoriaController::class)->names('admin.categorias');
    Route::resource('recetas', AdminRecetaController::class)->names('admin.recetas');
    Route::resource('contactos', App\Http\Controllers\Admin\ContactoController::class)->only(['index', 'show', 'destroy'])->names('admin.contactos');
    Route::get('contenido', [AdminContenidoController::class, 'index'])->name('admin.contenido.index');
    Route::get('nosotros-contenido', [NosotrosContenidoController::class, 'edit'])->name('admin.nosotros.edit');
    Route::put('nosotros-contenido', [NosotrosContenidoController::class, 'update'])->name('admin.nosotros.update');
    Route::get('inicio-contenido', [InicioContenidoController::class, 'edit'])->name('admin.inicio-contenido.edit');
    Route::put('inicio-contenido', [InicioContenidoController::class, 'update'])->name('admin.inicio-contenido.update');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return redirect()->route('admin.productos.index');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
