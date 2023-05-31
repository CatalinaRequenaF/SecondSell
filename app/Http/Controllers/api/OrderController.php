<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Obtener todos los pedidos del usuario autenticado.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $user = Auth::user();
        $orders = $user->orders;

        return response()->json([
            'orders' => $orders
        ]);
    }

    /**
     * Crear un nuevo pedido.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        $validatedData = $request->validate([
            // Agrega aquí las reglas de validación para los campos del pedido
        ]);

        // Crea un nuevo pedido para el usuario autenticado
        $order = new Order($validatedData);
        $user->orders()->save($order);

        return response()->json([
            'message' => 'El pedido se ha creado correctamente.',
            'order' => $order
        ], 201);
    }

    /**
     * Mostrar los detalles de un pedido específico.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Order $order)
    {
        $user = Auth::user();

        // Verifica que el pedido pertenezca al usuario autenticado
        if ($order->user_id !== $user->id) {
            return response()->json([
                'message' => 'No tienes permiso para acceder a este pedido.'
            ], 403);
        }

        return response()->json([
            'order' => $order
        ]);
    }

    /**
     * Actualizar un pedido existente.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Order $order)
    {
        $user = Auth::user();

        // Verifica que el pedido pertenezca al usuario autenticado
        if ($order->user_id !== $user->id) {
            return response()->json([
                'message' => 'No tienes permiso para actualizar este pedido.'
            ], 403);
        }

        $validatedData = $request->validate([
            // Agrega aquí las reglas de validación para los campos que se pueden actualizar
        ]);

        $order->update($validatedData);

        return response()->json([
            'message' => 'El pedido se ha actualizado correctamente.',
            'order' => $order
        ]);
    }

    /**
     * Eliminar un pedido.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Order $order)
    {
        $user = Auth::user();

        // Verifica que el pedido pertenezca al usuario autenticado
        if ($order->user_id !== $user->id) {
            return response()->json([
                'message' => 'No tienes permiso para eliminar este pedido.'
            ], 403);
        }

        $order->delete();

        return response()->json([
            'message' => 'El pedido se ha eliminado correctamente.'
        ]);
    }
}
