<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProjectRequestController;


use App\Http\Controllers\PerfilController;

//Esta configuracion lo añadi cuando tenia problemas de cors
Route::options('{any}', function () {
    return response()->json([], 200, [
        'Access-Control-Allow-Origin' => '',
        'Access-Control-Allow-Methods' => 'GET, POST, PUT, DELETE, OPTIONS',
        'Access-Control-Allow-Headers' => 'Content-Type, Authorization',
    ]);
})->where('any', '.');
    
//formRegister hace peticion a esta ruta para registrar al usuario , crearlo y añadirlo base de datos
    Route::post('/register', [AuthController::class, 'register']);
//formLogin hace peticion a esta ruta para validar y buscar usuario 
    Route::post('/login', [AuthController::class, 'login']);
//En shopView hago peticion GET para obtener los productos que tengo en la base de datos 
    Route::get('/products', [ProductoController::class, 'apiIndex']);
//En formulario IA (ChatIa llamado en el proyecto), hace peticion a esta ruta POST para enviar las
//peticiones de proyecto que hace el usuario y se añadio un GET para obtener los tipos de proyectos
//pensando en añadir mas tipos de poryectos. 
    Route::prefix('project-requests')->group(function () {
        Route::post('/', [ProjectRequestController::class, 'store']);
        Route::get('/project-types', [ProjectRequestController::class, 'getProjectTypes']);
    });

    
    Route::middleware('auth:sanctum')->group(function () {
        
        Route::get('/user', function (Request $request) {
            return $request->user();
        });
        //Si el usuario esta autenticado, podria ver sus pedidos en perfil
        Route::post('/pedidos', [PedidoController::class, 'store']);
        Route::get('/pedidos/{id}', [PedidoController::class, 'show']);
        //obetener la informacion del usuario, correo,nombre etc..
        Route::get('/user/profile', [UserController::class, 'getUserProfile']);
        //obtendra los pedidos y peticiones de proyeto relacionados a este perfil
        Route::get('/perfil/datos', [PerfilController::class, 'misPedidosYPeticiones']);
        //esta ruta NO tuve tiempo a usarlas en perfil, TODO:poder permitir cambiar de contraseña. 
        Route::post('/user/cambiar-contra', [AuthController::class, 'cambiarContrasena']);
        Route::post('/logout', [AuthController::class, 'logout']);
    });

    
