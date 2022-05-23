<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Product::class;

    public function definition()
    {
        return [
            'name' => $this->faker->sentence(mt_rand(2, 6)),
            'slug' => $this->faker->slug(),
            'excerpt' => $this->faker->paragraph(),
            'price' => $this->faker->numberBetween(1000000, 5000000),
            'workDuration' => $this->faker->numberBetween(10, 60),
            'weight' => $this->faker->numberBetween(2, 40),
            'stock' => $this->faker->numberBetween(2, 20),
            'description' => $this->faker->paragraph(mt_rand(5, 10)),
            'imageAssets' => 'product-images/sofa1a.png',
            'category_id' => mt_rand(1, 3),
            'product_availability_id' => mt_rand(1, 2),
        ];
    }
}
