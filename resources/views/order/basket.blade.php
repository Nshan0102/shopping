@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div>{{ __('Basket') }}</div>
                        <div>
                            @if(count($products) > 0)
                                <a class="btn btn-primary" href="{{ route("checkout") }}">
                                    {{ __('Checkout') }}
                                </a>
                            @endif
                        </div>
                    </div>
                    <div class="card-body">
                        @include('_partials.product.allProducts', [
                            "products" => $products,
                            "showRemove" => true,
                            "showAddToBasket" => true,
                            "paginate" => false,
                            "action" => "update"
                        ])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection