<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class BasketController extends Controller
{
    public function index(Request $request)
    {
        return view('order.basket', ['products' => Product::with('productable')->limit(12)->get()]);
    }
}
