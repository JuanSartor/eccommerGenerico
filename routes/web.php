<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\SupercategoriaController;

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

/* Route::get('/', function () {
  return view('index');
  })->name('home');
 */
Route::get('/', [ProductoController::class, 'indexDestacados'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';

/* Categoria */
Route::get('/categoria/ver/{id}', [CategoriaController::class, 'ver'])->name('categoria.ver');
Route::get('/categorias', [CategoriaController::class, 'index'])->name('categoria.index');
Route::get('/categoria/crear', [CategoriaController::class, 'crear'])->name('categoria.crear');
Route::post('guardarCategoria', [CategoriaController::class, 'save'])->middleware('auth')->name('guardarCategoria');

/* Producto */
Route::get('/productos', [ProductoController::class, 'index'])->name('producto.gestion');
Route::get('/producto/crear', [ProductoController::class, 'crear'])->name('producto.crear');
Route::get('producto/{id}/editar', [ProductoController::class, 'editar'])->name('producto.editar');
Route::post('/productos', [ProductoController::class, 'guardar'])->name('producto.guardar');
Route::delete('/productos/{id}', [ProductoController::class, 'eliminar'])->name('productos.eliminar');
Route::get('/producto/{id}', [ProductoController::class, 'ver'])->name('producto.ver');

/* Pedido */

Route::middleware('auth')->group(function () {
    Route::get('/pedidos', [PedidoController::class, 'index'])->name('pedido.gestion');
    Route::get('/pedido/detalle/{id}', [PedidoController::class, 'detalle'])->name('pedido.detalle');
    Route::post('/pedido/estado', [PedidoController::class, 'updateEstado'])->name('pedidos.updateEstado');
    Route::get('/pedido/realizar', [PedidoController::class, 'realizar'])->name('pedido.realizar');
    Route::post('/pedido/guardar', [PedidoController::class, 'guardar'])->name('pedido.guardar');
    Route::get('/pedido/confirmado', [PedidoController::class, 'confirmado'])->name('pedido.confirmar');
    Route::get('/pedidos/mispedidos', [PedidoController::class, 'mispedidos'])->name('pedido.mispedidos');
});

/* Carrito */
Route::get('/carrito', [CarritoController::class, 'index'])->name('carrito.index');
Route::get('/carrito/agregar/{id}', [CarritoController::class, 'agregar'])->name('carrito.agregar');
Route::get('/carrito/eliminar/{index}', [CarritoController::class, 'eliminar'])->name('carrito.eliminar');
Route::get('/carrito/vaciar', [CarritoController::class, 'vaciar'])->name('carrito.vaciar');
Route::get('/carrito/incrementar/{index}', [CarritoController::class, 'incrementar'])->name('carrito.incrementar');
Route::get('/carrito/decrementar/{index}', [CarritoController::class, 'decrementar'])->name('carrito.decrementar');

/* Supercategoria */
Route::get('/supercategoria/ver/{id}', [SupercategoriaController::class, 'ver'])->name('supercategoria.ver');
Route::get('/supercategorias', [SupercategoriaController::class, 'index'])->name('supercategoria.index');
Route::get('/supercategoria/crear', [SupercategoriaController::class, 'crear'])->name('supercategoria.crear');
Route::post('guardar', [SupercategoriaController::class, 'save'])->middleware('auth')->name('guardar');
