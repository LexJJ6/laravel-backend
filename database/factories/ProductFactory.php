<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
            'name' => $this->faker->unique()->word(),
            'category' => $this->faker->unique()->word(),
            'price' => $this->faker->numberBetween(50, 3000),
            'stock' => $this->faker->numberBetween(0, 100),
        ];
    }
}
