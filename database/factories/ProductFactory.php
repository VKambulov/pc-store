<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->sentence(),
            'price' => fake()->randomFloat(max: 500000),
            'description' => fake()->text(),
        ];
    }
}
