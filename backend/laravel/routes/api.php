<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductoController;



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

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/user', function (Request $request) {
            return $request->user();
        });
        

        Route::post('/user/cambiar-contra', [AuthController::class, 'cambiarContrasena']);
        Route::post('/logout', [AuthController::class, 'logout']);
    });

    
