<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\CommunityController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\CommentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//######################## USUARIO ############################

//--------------------Perfil del usuario (Sanctum)----------------------------
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//--------------------Registro de usuarios----------------------------
Route::post('/register', [AuthController::class, 'register']);

//--------------------Login de usuarios----------------------------
Route::post('/login', [AuthController::class, 'login']);




//########### RUTAS QUE REQUIEREN INICIO DE SESIÓN/AUTORIZACIÓN #########

Route::middleware('auth:sanctum')->group(function(){

    //--Hacer Logout---------------------------------------
    Route::get('logout', [AuthController::class, 'logout']);
    
    //--Crear, actualizar y borrar categorías--------------
    Route::apiResource('categories', CategoryController::class)->except([
        'index', 'show'
    ]);

    //--Crear, actualizar y borrar productos--------------
    Route::apiResource('products', ProductController::class)->except([
        'index', 'show'
    ]);

});

//Grupo que no requiere autorizacion

//Ver todas las categorías
Route::apiResource('categories', CategoryController::class)->only([
    'index', 'show'
]);

//Ver todos los productos
Route::apiResource('products', ProductController::class)->only([
    'index', 'show'
]);
