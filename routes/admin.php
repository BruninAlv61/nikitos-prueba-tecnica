<?php

use App\Http\Controllers\Admin\CategoriaController as AdminCategoriaController;
use App\Http\Controllers\Admin\ContactoController as AdminContactoController;
use App\Http\Controllers\Admin\ContenidoController as AdminContenidoController;
use App\Http\Controllers\Admin\InicioContenidoController;
use App\Http\Controllers\Admin\NosotrosContenidoController;
use App\Http\Controllers\Admin\ProductoController as AdminProductoController;
use App\Http\Controllers\Admin\RecetaController as AdminRecetaController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::resource('productos', AdminProductoController::class)->names('admin.productos');
    Route::resource('categorias', AdminCategoriaController::class)->names('admin.categorias');
    Route::resource('recetas', AdminRecetaController::class)->names('admin.recetas');
    Route::resource('contactos', AdminContactoController::class)->only(['index', 'show', 'destroy'])->names('admin.contactos');
    Route::get('contenido', [AdminContenidoController::class, 'index'])->name('admin.contenido.index');
    Route::get('nosotros-contenido', [NosotrosContenidoController::class, 'edit'])->name('admin.nosotros.edit');
    Route::put('nosotros-contenido', [NosotrosContenidoController::class, 'update'])->name('admin.nosotros.update');
    Route::get('inicio-contenido', [InicioContenidoController::class, 'edit'])->name('admin.inicio-contenido.edit');
    Route::put('inicio-contenido', [InicioContenidoController::class, 'update'])->name('admin.inicio-contenido.update');
});
