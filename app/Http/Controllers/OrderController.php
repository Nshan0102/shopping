<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\BasketService;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $calculator;
    protected $orderService;
    protected $basketService;

    public function __construct(OrderService $orderService, BasketService $basketService)
    {
        parent::__construct();
        $this->orderService = $orderService;
        $this->basketService = $basketService;
    }

    public function checkout()
    {
        $this->setCalculator(auth()->user());
        return view("order.checkout", ["order" => $this->getOrder()]);
    }

    public function store(Request $request, $payment)
    {
        if (!in_array($payment, Order::PAYMENT_METHODS)) {
            return redirect('home');
        }
        $orderDetails = $this->getOrder();
        $order = $this->orderService->store($orderDetails, $request->payment);
        if (!$order) {
            return redirect('home');
        }
        $this->basketService->setProducts([]);
        return view("order.history", ["orders" => auth()->user()->orders]);
    }

    public function history()
    {
        return view("order.history", ["orders" => auth()->user()->orders]);
    }

    public function details(Order $order)
    {
        $orderWithAllRelations = Order::where("id", $order->id)
            ->with('products.product.productable')->first();
        return view('order.details', ["order" => $orderWithAllRelations]);
    }

    private function setCalculator($user)
    {
        $this->calculator = $this->orderService->getCalculator($user->calculation_type);
    }

    private function getOrder(): array
    {
        $this->setCalculator(auth()->user());
        $this->calculator->setProducts($this->basketService->getProductsByBasket());
        $this->calculator->setQuantities($this->basketService->getProductQuantities());
        return $this->orderService->calculate($this->calculator);
    }
}
