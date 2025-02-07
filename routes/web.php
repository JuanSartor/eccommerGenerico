<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\PedidoController;

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */

Route::get('/', function () {
    return view('index');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';

/* Categoria */
Route::get('/categoria/ver/{id}', [CategoriaController::class, 'ver'])->name('categoria.ver');
Route::get('/categorias', [CategoriaController::class, 'index'])->name('categoria.index');
Route::get('/categoria/crear', [CategoriaController::class, 'crear'])->name('categoria.crear');
Route::post('guardar', [CategoriaController::class, 'save'])->middleware('auth')->name('guardar');

/* Producto */
Route::get('/productos', [ProductoController::class, 'index'])->name('producto.gestion');
Route::get('/producto/crear', [ProductoController::class, 'crear'])->name('producto.crear');
Route::get('producto/{id}/editar', [ProductoController::class, 'editar'])->name('producto.editar');
Route::post('/productos', [ProductoController::class, 'guardar'])->name('producto.guardar');
Route::delete('/productos/{id}', [ProductoController::class, 'eliminar'])->name('productos.eliminar');

/* Pedido */

Route::get('/pedidos', [PedidoController::class, 'index'])->name('pedido.gestion');
Route::get('/pedido/detalle/{id}', [PedidoController::class, 'detalle'])->name('pedidos.detalle');
Route::post('/pedido/estado', [PedidoController::class, 'updateEstado'])->name('pedidos.updateEstado');
