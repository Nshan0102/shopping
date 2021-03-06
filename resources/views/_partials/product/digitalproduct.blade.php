<div class="card-body">
    @if(isset($showRemove) && $showRemove === true)
        <button data-product-id="{{ $product->id }}" class="remove-product btn btn-sm">
            <i class="fas fa-trash-alt"></i>
        </button>
    @endif
    <div class="product-field-wrapper">
        <h4 class="card-title">
            <a href="{{ route('product.show', $product) }}">{{ $product->name }}</a>
        </h4>
        <h6 class="card-subtitle mb-2 text-muted">Category:
            <span class="badge rounded p-1 {{ $product->getCategoryClass() }}">
            {{ $product->getCategory() }}
        </span>
        </h6>
        <div>Platform:
            <a target="_blank" href="{{ $product->productable->platform }}">
                {{ $product->productable->platform }}
            </a>
        </div>
        <div>
            Stored: {{ $product->created_at }}
        </div>
    </div>
    @if($showAddToBasket)
        <div class="buy d-flex justify-content-between align-items-center product">
            <div class="price text-success"><span>${{ $product->price }}</span></div>
            <input value="{{ !empty($quantities) ? $quantities[$index] : 1 }}" type="number" min="1" class="quantity">
            <button data-product-id="{{ $product->id }}" class="btn btn-sm btn-info {{$action}}-product">
                <i class="fas fa-shopping-cart"></i>
                {{ __(ucfirst($action)) }}
            </button>
        </div>
    @endif
</div>