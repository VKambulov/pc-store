<?php

namespace Database\Factories;

use App\Enums\OrderStatus;
use App\Enums\OrderType;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Order>
 */
class OrderFactory extends Factory
{
    public function definition(): array
    {
        return [
            'order_num' => 'МП-' . fake()->ean8(),
            'user_id' => User::factory(),
            'type' => OrderType::Pickup,
            'status' => OrderStatus::Pending,
        ];
    }
}
