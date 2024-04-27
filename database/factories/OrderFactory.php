<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition()
    {
        return [
            'product_name' => $this->faker->word,
            'customer' => $this->faker->name,
            'status' => $this->faker->randomElement(['Válászra vár', 'Nincs kiszállítva', 'Úton a raktárból', 'Úton az ügyfélhez', 'Úton az üzletbe', 'Kiszállítva']),
            'verified' => $this->faker->boolean,
            'base_price' => $this->faker->numberBetween(100, 1000),
            'quantity' => $this->faker->numberBetween(1, 100),
            'date' => $this->faker->dateTime,
        ];
    }
}
