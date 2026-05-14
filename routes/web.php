<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaginaController;
use App\Http\Controllers\ProductoController;

Route::get('/', [PaginaController::class, 'home'])->name('home');
Route::get('/productos', [ProductoController::class, 'index'])->name('productos');
Route::get('/productos/{categoria}', [ProductoController::class, 'categoria'])->name('productos.categoria');
Route::get('/nosotros', [PaginaController::class, 'nosotros'])->name('nosotros');
Route::get('/donde-comprar', [PaginaController::class, 'dondeComprar'])->name('donde-comprar');
Route::get('/contacto', [PaginaController::class, 'contacto'])->name('contacto');