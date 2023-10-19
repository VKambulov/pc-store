<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        Order::factory(25)
            ->hasAttached(Product::factory()->count(5), [
                'price' => fake()->randomFloat(max: 500000),
                'quantity' => rand(1, 10),
            ])
            ->create();
    }
}
