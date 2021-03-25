<?php

namespace Database\Factories;

use App\Models\PhysicalProduct;
use Illuminate\Database\Eloquent\Factories\Factory;

class PhysicalProductFactory extends Factory
{
    protected $model = PhysicalProduct::class;

    public function definition(): array
    {
        return [
            'dimension' => $this->faker->fileExtension,
            'color' => $this->faker->hexColor,
            'free_shipping' => $this->faker->boolean(30)
        ];
    }
}
