@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>{{ __('Checkout') }}</h1>
        <div class="row justify-content-center">
            <table class="table mb-0">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">SUM ( TAX {{ $order["tax"] }}% )</th>
                </tr>
                </thead>
                <tbody>
                @foreach($order["products"] as $product)
                    <tr>
                        <th scope="row">{{ $product->id }}</th>
                        <th>
                            <a href="{{ route('product.show', $product) }}">
                                {{ $product->name }}
                            </a>
                        </th>
                        <th>{{ $product->price }}</th>
                        <th>{{ $product->quantity }}</th>
                        <th>{{ number_format($product->sum, 2, ".", ",") }}</th>
                    </tr>
                @endforeach
                <tr class="bg-secondary color-white">
                    <th scope="row"><b>SUM</b></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>{{ number_format($order["sum"], 2, ".", ",") }}</th>
                </tr>
                </tbody>
            </table>
            @if($order["sum"] > 0)
                <a id="buy-button" class="btn btn-primary w-100"
                   data-href="{{ route("order.pay", ["payment" => "cash"]) }}" href="javascript:void(0)">
                    <b>BUY</b>
                </a>
            @endif
        </div>
    </div>
@endsection