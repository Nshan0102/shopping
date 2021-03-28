<?php


namespace App\Services;


use App\Interfaces\CalculateInterface;

class CalculateWithTax implements CalculateInterface
{
    const TAX = 0;
    public $products;
    public $quantities;

    public function setProducts($products)
    {
        $this->products = $products;
    }

    public function setQuantities($quantities)
    {
        $this->quantities = $quantities;
    }

    public function getCalculator(): CalculateWithTax
    {
        return $this;
    }
}