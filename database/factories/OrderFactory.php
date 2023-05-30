<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {
        $user = User::inRandomOrder()->first();
        $products = Product::inRandomOrder()->limit(3)->get();

        $order = new Order();
        $order->user()->associate($user);
        $order->save();

        foreach ($products as $product) {
            $orderItem = new OrderItem();
            $orderItem->order()->associate($order);
            $orderItem->product()->associate($product);
            $orderItem->save();
        }

        

        
    $order->calculateSubtotal();

        return [];
    }
}
