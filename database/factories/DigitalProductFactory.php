<?php

namespace Database\Factories;

use App\Models\DigitalProduct;
use Illuminate\Database\Eloquent\Factories\Factory;

class DigitalProductFactory extends Factory
{
    protected $model = DigitalProduct::class;

    public function definition(): array
    {
        return [
            'platform' => $this->faker->domainName
        ];
    }
}
