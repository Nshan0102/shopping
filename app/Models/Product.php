<?php

namespace App\Models;

use App\Interfaces\ProductInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Product extends Model implements ProductInterface
{
    protected $fillable = [
        'name',
        'slug',
        'price',
        'discount'
    ];

    public function productable(): MorphTo
    {
        return $this->morphTo();
    }
}
