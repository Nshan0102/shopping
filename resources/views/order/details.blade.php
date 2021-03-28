@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <table class="table mb-0">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">SUM ( TAX {{ $order->tax }}% )</th>
                </tr>
                </thead>
                <tbody>
                @foreach($order->products as $orderProduct)
                    <tr>
                        <th scope="row">{{ $orderProduct->id }}</th>
                        <th>
                            <a href="{{ route('product.show', $orderProduct->product->id) }}">
                                {{ $orderProduct->product->name }}
                            </a>
                        </th>
                        <th>{{ $orderProduct->price }}</th>
                        <th>{{ $orderProduct->quantity }}</th>
                        <th>{{ number_format($orderProduct->sum, 2, ".", ",") }}</th>
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
        </div>
    </div>
@endsection