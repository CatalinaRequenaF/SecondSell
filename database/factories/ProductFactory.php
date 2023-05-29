<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
        'name' => fake()->word(),
        'description' => fake()->sentence(),
        'state' => fake()->randomElement(['new', 'good', 'used', ]),
        'price' => fake()->randomDigit(),
        'active'=>  fake()->randomElement(['active', 'selled', 'inactive', ]),
        'seller_id'=>User::find(1),
        'category_id'=>Category::find(1)
        ];
    }
}
