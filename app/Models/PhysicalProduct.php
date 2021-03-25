<?php

namespace App\Models;

use App\Interfaces\ProductInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class PhysicalProduct extends Model implements ProductInterface
{
    use HasFactory;

    protected $fillable = [
        'dimension',
        'color',
        'free_shipping'
    ];

    public function product(): MorphOne
    {
        return $this->morphOne(Product::class, 'productable');
    }
}
