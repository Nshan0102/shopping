<?php

namespace App\Http\Controllers;

use App\Http\Requests\BasketRemoveRequest;
use App\Http\Requests\BasketSetRequest;
use App\Http\Requests\BasketStoreRequest;
use App\Services\BasketService;

class BasketController extends Controller
{
    protected $basketService;

    public function __construct(BasketService $basketService)
    {
        parent::__construct();
        $this->basketService = $basketService;
    }

    public function index()
    {
        $products = $this->basketService->getProductsByBasket();
        $quantities = $this->basketService->getProductQuantities();
        return view("order.basket", [
            "products" => $products,
            "quantities" => $quantities
        ]);
    }

    public function set(BasketSetRequest $request)
    {
        $basket = $request->products;
        $this->basketService->setProducts($basket);
        return session()->get("basket");
    }

    public function add(BasketStoreRequest $request)
    {
        $basket = session()->get("basket");
        $found = false;
        $product = $this->basketService->makeProduct($request->product);
        $this->basketService->changeProductQuantity($basket, $product, $found, "add");
        $this->basketService->pushProduct($basket, $product, $found);
        $this->basketService->setProducts($basket);
        return session()->get("basket");
    }

    public function update(BasketStoreRequest $request)
    {
        $basket = session()->get("basket");
        $product = $this->basketService->makeProduct($request->product);
        $this->basketService->changeProductQuantity($basket, $product, $found, "update");
        $this->basketService->setProducts($basket);
        return session()->get("basket");
    }

    public function remove(BasketRemoveRequest $request)
    {
        $basket = session()->get("basket");
        $this->basketService->removeProduct($basket, (int) $request->product["id"]);
        $this->basketService->setProducts($basket);
        return session()->get("basket");
    }
}
