<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class PhysicalProduct extends Model
{
    public function product(): MorphOne
    {
        return $this->morphOne(Product::class, 'productable');
    }
}
