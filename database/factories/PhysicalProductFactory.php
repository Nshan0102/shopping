<?php

namespace Database\Factories;

use App\Models\PhysicalProduct;
use Illuminate\Database\Eloquent\Factories\Factory;

class PhysicalProductFactory extends Factory
{
    protected $model = PhysicalProduct::class;

    public function definition(): array
    {
        $height = $this->faker->randomFloat(2, 12, 1500);
        $length = $this->faker->randomFloat(2, 12, 1500);
        $width = $this->faker->randomFloat(2, 12, 1500);
        return [
            'dimension' => $height." x ".$length." x ".$width,
            'color' => $this->faker->hexColor,
            'free_shipping' => $this->faker->boolean(30)
        ];
    }
}
