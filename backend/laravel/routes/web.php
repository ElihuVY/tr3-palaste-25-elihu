<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\PeticionProyectoController;


Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    // Rutas para Categorías
    Route::resource('categorias', CategoriaController::class);

    // Rutas para Productos
    Route::resource('productos', ProductoController::class);

    // Rutas para Pedidos
    Route::get('/pedidos', [PedidoController::class, 'index'])->name('pedidos.index');
    Route::get('/pedidos/{pedido}', [PedidoController::class, 'show'])->name('pedidos.show');
    Route::put('/pedidos/{pedido}', [PedidoController::class, 'update'])->name('pedidos.update');

    // Rutas para Proyectos
    Route::get('/proyectos', [PeticionProyectoController::class, 'index'])->name('proyectos.index');
    Route::get('/proyectos/{peticion}', [PeticionProyectoController::class, 'show'])->name('proyectos.show');
    Route::put('/proyectos/{peticion}', [PeticionProyectoController::class, 'update'])->name('proyectos.update');
});
