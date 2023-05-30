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

        // Create order
        $order = new Order();
     
        // Associate this order with the user
        $order->user()->associate($user);       
        
        // Associate items to this order
        foreach ($products as $product) {

            // Create item order
            $orderItem = new OrderItem();   

            // Associate this item to the order
            $orderItem->order()->associate($order);

            // Associate the product to the order item
            $orderItem->product()->associate($product);
            $orderItem->name=$product->name();

            // Save order item
            $orderItem->save();

        }
        
        var_export($order->getAttributes()); die(); 
        
        $order->save();       
        
        die('hols');   



        //$order->save();



    $order->calculateSubtotal();

        return [];
    }
}
