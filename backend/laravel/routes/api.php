<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProjectRequestController;


use App\Http\Controllers\PerfilController;


Route::options('{any}', function () {
    return response()->json([], 200, [
        'Access-Control-Allow-Origin' => '',
        'Access-Control-Allow-Methods' => 'GET, POST, PUT, DELETE, OPTIONS',
        'Access-Control-Allow-Headers' => 'Content-Type, Authorization',
    ]);
})->where('any', '.');

    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/products', [ProductoController::class, 'apiIndex']);
    
    Route::prefix('project-requests')->group(function () {
        Route::post('/', [ProjectRequestController::class, 'store']);
        Route::get('/project-types', [ProjectRequestController::class, 'getProjectTypes']);
    });
    
    Route::middleware('auth:sanctum')->group(function () {

        Route::get('/user', function (Request $request) {
            return $request->user();
        });
        Route::post('/pedidos', [PedidoController::class, 'store']);
        Route::get('/pedidos/{id}', [PedidoController::class, 'show']);
        
        Route::get('/user/profile', [UserController::class, 'getUserProfile']);
        Route::get('/perfil/datos', [PerfilController::class, 'misPedidosYPeticiones']);

        Route::post('/user/cambiar-contra', [AuthController::class, 'cambiarContrasena']);
        Route::post('/logout', [AuthController::class, 'logout']);
    });

    
