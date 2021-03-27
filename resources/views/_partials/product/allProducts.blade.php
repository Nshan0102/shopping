@if(!isset($paginate) || $paginate === true)
    <div class="row d-flex justify-content-around">
        {{ $products->links('vendor.pagination.bootstrap-4') }}
    </div>
@endif
<div class="row d-flex justify-content-around">
    @foreach($products as $product)
        <div class="col-12 col-sm-8 col-md-6 col-lg-4 mb-3">
            <div class="card product-card">
                @include($product->getViewPartialPath(), ['product' => $product])
            </div>
        </div>
    @endforeach
</div>
@if(!isset($paginate) || $paginate === true)
    <div class="row d-flex justify-content-around">
        {{ $products->links('vendor.pagination.bootstrap-4') }}
    </div>
@endif