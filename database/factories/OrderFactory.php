<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            // 'user_id' => mt_rand(3, 5),
            // 'price' => $this->faker->numberBetween(1000000, 5000000),
            // 'quantity' => $this->faker->numberBetween(1, 10),
            // 'status' => $this->faker->word(),
        ];
    }
}
