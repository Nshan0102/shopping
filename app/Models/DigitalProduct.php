<?php

namespace App\Models;

use App\Interfaces\ProductInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class DigitalProduct extends Model implements ProductInterface
{
    use HasFactory;

    protected $fillable = [
        'platform'
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d h:i:s'
    ];

    public function product(): MorphOne
    {
        return $this->morphOne(Product::class, 'productable');
    }
}
