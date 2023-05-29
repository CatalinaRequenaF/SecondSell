<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Obtener el carrito de compras del usuario actual.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show()
    {
        $user = Auth::user();
        $cart = $user->cart;

        // Si no existe un carrito para el usuario, se crea automáticamente
        if (!$cart) {
            $cart = Cart::create([
                'user_id' => $user->id
            ]);
        }

        $cart->load('products');

        return response()->json([
            'cart' => $cart
        ]);
    }

    /**
     * Agregar un producto al carrito de compras del usuario actual.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addToCart(Request $request)
    {
        $user = Auth::user();
        $cart = $user->cart;

        // Si no existe un carrito para el usuario, se crea automáticamente
        if (!$cart) {
            $cart = Cart::create([
                'user_id' => $user->id
            ]);
        }

        $cart->products()->attach($request->product_id);

        return response()->json([
            'message' => 'El producto se ha agregado al carrito.'
        ]);
    }

    /**
     * Eliminar un producto del carrito de compras del usuario actual.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function removeFromCart(Request $request)
    {
        $user = Auth::user();
        $cart = $user->cart;

        // Verificar si existe un carrito para el usuario
        if ($cart) {
            $cart->products()->detach($request->product_id);
        }

        return response()->json([
            'message' => 'El producto se ha eliminado del carrito.'
        ]);
    }
}
