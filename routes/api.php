<?php

use App\Http\Controllers\Api\AddressController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\DiscountController;
use App\Http\Controllers\Api\FollowController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\AuthController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;

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



//########### RUTAS QUE REQUIEREN INICIO DE SESIÓN/AUTORIZACIÓN #########

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('signup', [AuthController::class, 'signup']);
  
    Route::group(['middleware' => 'auth:api'], function() {
        Route::get('logout', [AuthController::class, 'logout']);
        Route::get('user', [AuthController::class, 'user']);
    });
});

//######################## USUARIO ############################

//--------------------Perfil del usuario (Sanctum)----------------------------
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



Route::middleware('auth:api')->group(function(){

    //--Crear, actualizar y borrar categorías--------------
    Route::apiResource('categories', CategoryController::class)->except([
        'index', 'show'
    ]);

    //--Crear, actualizar y borrar productos--------------
    Route::apiResource('products', ProductController::class)->except([
        'index', 'show'
    ]);

    //--Direcciones 
     Route::apiResource('{user/address', AddressController::class);

    //--Carrito 
    Route::apiResource('{user}/cart', CartController::class);

    //Teléfono
    Route::apiResource('{user}/phone', CartController::class);

    //Descuento
    Route::apiResource('{id}/discount', DiscountController::class);

    //--seguidores 
    Route::apiResource('{user}/followers', FollowController::class);
    Route::apiResource('{user}/followed', FollowController::class);

    //Imágenes de producto

    //Pedidos
    Route::apiResource('{user}/order', OrderController::class);

});

//#################### Grupo que no requiere autorizacion ####################

//Ver todas las categorías
Route::apiResource('categories', CategoryController::class)->only([
    'index', 'show'
]);

//Ver todos los productos
Route::apiResource('products', ProductController::class)->only([
    'index', 'show'
]);

//Imágenes de producto
Route::apiResource('{product}/image', ProductController::class);
