<?php


namespace App\Interfaces;


use Illuminate\Database\Eloquent\Relations\MorphOne;

interface ProductInterface
{
    public function product(): MorphOne;
}