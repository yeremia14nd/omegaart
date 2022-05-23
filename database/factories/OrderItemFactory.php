<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class OrderItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'product_id' => mt_rand(1, 5),
            'order_id' => mt_rand(1, 5),
            'price' => $this->faker->numberBetween(1000000, 5000000),
            'total_price' => $this->faker->numberBetween(5000000, 10000000),
            'quantity' => $this->faker->numberBetween(1, 10),
            'status' => $this->faker->word(),
        ];
    }
}
