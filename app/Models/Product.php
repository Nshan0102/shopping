<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Product extends Model
{
    use HasFactory;

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

    public function getViewPartialPath(): string
    {
        $type = explode('\\', $this->productable_type);
        return '_partials.product.'.strtolower($type[count($type) - 1]);
    }

    public function getCategory(): string
    {
        $type = explode('\\', $this->productable_type);
        return preg_replace('/(?<!\ )[A-Z]/', ' $0', $type[count($type) - 1]);
    }

    public function getCategoryClass(): string
    {
        $type = explode('\\', $this->productable_type);
        switch ($type[count($type) - 1]) {
            case "DigitalProduct":
                return "category-digital-text";
            case "PhysicalProduct":
                return "category-physical-text";
            default:
                return "";
        }
    }
}
