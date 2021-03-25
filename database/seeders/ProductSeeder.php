<?php

namespace Database\Seeders;

use App\Models\DigitalProduct;
use App\Models\PhysicalProduct;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    protected const PRODUCT_TYPES = [
        DigitalProduct::class,
        PhysicalProduct::class
    ];

    /**
     * @return void
     */
    public function run()
    {
        $i = 0;
        while ($i < 50) {
            $productable = $this->getNewProductable();
            $product = Product::factory()->create();
            $productable->product()->save($product);
            $i++;
        }
    }

    /**
     * @return mixed
     */
    private function getNewProductable()
    {
        $class = collect(self::PRODUCT_TYPES)->random();
        return (new $class)->factory()->create();
    }
}
