<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        $name = $this->faker->unique()->name;
        return [
            'name' => $this->faker->name,
            'slug' => Str::slug($name).'-'.$this->faker->unique()->slug,
            'price' => $this->faker->randomFloat(),
            'discount' => $this->faker->randomDigit
        ];
    }
}
