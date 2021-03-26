<div class="card-body">
    <div class="product-field-wrapper">
        <h4 class="card-title">{{ $product->name }}</h4>
        <h6 class="card-subtitle mb-2 text-muted">Category:
            <span class="badge rounded p-1 {{ $product->getCategoryClass() }}">
            {{ $product->getCategory() }}
        </span>
        </h6>
        <div>Platform: {{ $product->productable->platform }}</div>
        <div>
            Stored: {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $product->created_at)->toDayDateTimeString() }}
        </div>
    </div>
    <div class="buy d-flex justify-content-between align-items-center">
        <div class="price text-success"><h5 class="mt-4">${{ $product->price }}</h5></div>
        <a href="#" class="btn btn-sm btn-info mt-3"><i class="fas fa-shopping-cart"></i> Add to Cart</a>
    </div>
</div>