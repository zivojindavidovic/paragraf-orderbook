<?php

namespace Database\Factories;

use App\Models\Stock;
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
        return [
            'price' => fake()->randomNumber(3),
            'quantity' => fake()->randomNumber(3),
            'type' => fake()->randomElement(['sell', 'buy']),
            'user_id' => User::factory(),
            'stock_id' => Stock::factory()
        ];
    }
}
