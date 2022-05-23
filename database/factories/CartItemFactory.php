<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CartItemFactory extends Factory
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
            'cart_id' => mt_rand(1, 5),
            'price' => $this->faker->numberBetween(1000000, 5000000),
            'quantity' => $this->faker->numberBetween(1, 10),
            'active' => $this->faker->boolean(),
        ];
    }
}
