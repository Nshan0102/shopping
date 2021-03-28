@extends('layouts.app')
@section('content')
    <div class="row d-flex justify-content-around">
        <div class="col-12 col-sm-8 col-md-6 col-lg-4 mb-3">
            <div class="card product-card">
                @include($product->getViewPartialPath(), [
                    "product" => $product,
                    "showRemove" => false,
                    "showAddToBasket" => true,
                    "quantities" => [],
                    "index" => null,
                    "action" => "buy"
                ])
            </div>
        </div>
    </div>
@endsection