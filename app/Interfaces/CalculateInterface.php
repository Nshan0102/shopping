<?php


namespace App\Interfaces;


interface CalculateInterface
{
    public function setProducts($products);

    public function setQuantities($quantities);

    public function getCalculator();
}