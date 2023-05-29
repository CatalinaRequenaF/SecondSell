<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Discount;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    //
/**
     * Obtener una lista de descuentos.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $discounts = Discount::all();

        return response()->json([
            'discounts' => $discounts
        ]);
    }

    /**
     * Crear un nuevo descuento.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'model_type' => 'required',
            'model_id' => 'required',
            'discount_amount' => 'required|numeric',
            // Agrega aquí más reglas de validación para tus campos
        ]);

        $discount = Discount::create($validatedData);

        return response()->json([
            'message' => 'El descuento se ha creado correctamente.',
            'discount' => $discount
        ], 201);
    }

    /**
     * Mostrar los detalles de un descuento específico.
     *
     * @param  \App\Models\Discount  $discount
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Discount $discount)
    {
        return response()->json([
            'discount' => $discount
        ]);
    }

    /**
     * Actualizar un descuento existente.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Discount  $discount
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Discount $discount)
    {
        $validatedData = $request->validate([
            'model_type' => 'required',
            'model_id' => 'required',
            'discount_amount' => 'required|numeric',
            // Agrega aquí más reglas de validación para tus campos
        ]);

        $discount->update($validatedData);

        return response()->json([
            'message' => 'El descuento se ha actualizado correctamente.',
            'discount' => $discount
        ]);
    }

    /**
     * Eliminar un descuento.
     *
     * @param  \App\Models\Discount  $discount
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Discount $discount)
    {
        $discount->delete();

        return response()->json([
            'message' => 'El descuento se ha eliminado correctamente.'
        ]);
    }    
}
