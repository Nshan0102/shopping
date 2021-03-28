<?php


namespace App\Services;


class BasketService
{
    public function makeProduct($product): array
    {
        return [
            "id" => (int) $product["id"],
            "quantity" => (int) $product["quantity"]
        ];
    }

    public function setProducts($basket)
    {
        $basketTemp = [];
        foreach ($basket as $product){
            $basketTemp[] = $this->makeProduct($product);
        }
        session(["basket" => $basketTemp]);
    }

    public function pushProduct(&$basket, $product, $found)
    {
        if (!$found) {
            array_push($basket, $product);
        }
    }

    public function changeProductQuantity(&$basket, $product, &$found, $action)
    {
        foreach ($basket as $key => $value) {
            if ($value["id"] === $product["id"]) {
                switch ($action){
                    case "update":
                        $basket[$key]["quantity"] = $product["quantity"];
                        break;
                    default:
                        $basket[$key]["quantity"] = $value["quantity"] + $product["quantity"];
                        break;
                }
                $found = true;
            }
        }
    }

    public function removeProduct(&$basket, $productId)
    {
        $basket = array_filter(
            session()->get("basket"),
            function ($product) use ($productId) {
                return $product["id"] !== $productId;
            }
        );
    }

    public function getProductIds(): array
    {
        $basket = session()->get("basket");
        if (!is_null($basket) && !empty($basket[0])){
            return array_map(
                function ($product) {
                    return $product["id"];
                },
                $basket
            );
        }
        return [];
    }

    public function getProductQuantities(): array
    {
        $basket = session()->get("basket");
        if (!is_null($basket) && !empty($basket[0])){
            return array_map(
                function ($product) {
                    return $product["quantity"];
                },
                $this->sortById()
            );
        }
        return [];
    }

    public function sortById()
    {
        $basket = session()->get("basket");
        $keys = array_column($basket, "id");
        array_multisort($keys, SORT_ASC, $basket);
        return $basket;
    }

    public function updateBasket(&$basket, $requestProduct, $action)
    {
        $found = false;
        $product = $this->basketService->makeProduct($requestProduct);
        $this->changeProductQuantity($basket, $product, $found, $action);
        $this->pushProduct($basket, $product, $found);
        $this->setProducts($basket);
    }
}