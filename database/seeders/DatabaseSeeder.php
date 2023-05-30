<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
        Category::factory(10)->create();

        //Creación de 10 usuarios
        User::factory(10)
        //2 direcciones por usuario
        ->hasAddresses(2)
        ->hasPhone()
        ->hasProducts(3)
        ->create();

        $users = User::all();
        foreach ($users as $user){
            $cart = new Cart();
            $cart->user_id = $user->id;
            $cart->save();
        };

        Order::factory(3)->create();

        
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        }
    
}
