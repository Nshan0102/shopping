@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>{{ __('Orders') }}</h1>
        <div class="row justify-content-center">
            <table class="table mb-0">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Products Count</th>
                    <th scope="col">SUM</th>
                    <th scope="col">Date</th>
                    <th scope="col">Details</th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr>
                        <th scope="row">{{ $order->id }}</th>
                        <th>{{ $order->products->count() }}</th>
                        <th>{{ $order->sum }}</th>
                        <th>{{ $order->created_at }}</th>
                        <th>
                            <a href="{{ route("order.details", ["order" => $order]) }}">
                                <i class="fas fa-eye"></i>
                            </a>
                        </th>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection