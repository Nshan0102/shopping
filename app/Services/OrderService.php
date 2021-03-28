<?php


namespace App\Services;


use App\Models\Order;
use App\Models\OrderProduct;

class OrderService
{
    public function getCalculator($calculationType)
    {
        switch ($calculationType) {
            case "without_tax":
                return new CalculateWithoutTax();
            default:
                return new CalculateWithTax();
        }
    }

    public function calculate($calculator): array
    {
        $order = [
            "products" => [],
            "sum" => 0,
            "tax" => $calculator::TAX
        ];
        foreach ($calculator->products as $index => $product) {
            $product->quantity = $calculator->quantities[$index];
            $price = $this->getPriceWithTax($product->quantity, $product->price, $calculator::TAX);
            $product->sum = round(ceil($price), 2,);
            $order["sum"] = round(ceil($order["sum"] + $product->sum), 2);
            $order["products"][] = $product;
        }
        return $order;
    }

    public function store($orderDetails, $payment)
    {
        if ($orderDetails["sum"] > 0) {
            $order = Order::create([
                "user_id" => auth()->id(),
                "tax" => ceil($orderDetails["tax"]),
                "sum" => ceil($orderDetails["sum"]),
                "payment" => $payment
            ]);
            foreach ($orderDetails["products"] as $product) {
                OrderProduct::create([
                    "order_id" => $order->id,
                    "product_id" => $product->id,
                    "price" => $product->price,
                    "quantity" => $product->quantity,
                    "sum" => $product->sum
                ]);
            }
            return $order;
        }
        return null;
    }

    public function getPriceWithTax($quantity, $price, $tax)
    {
        return ((int) $quantity * floatval($price)) + (floatval($price) * (int) $tax / 100);
    }
}