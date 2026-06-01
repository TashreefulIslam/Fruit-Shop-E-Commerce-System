@extends('layouts.app')

@section('title', $product->name . ' - Fruit Shop')

@section('extra-css')
<style>
    .breadcrumb {
        background-color: transparent;
    }

    .product-gallery {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        display: flex;
        align-items: center;
        justify-content: center;
        height: 400px;
    }

    .product-gallery img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
        padding: 2rem;
    }

    .gallery-placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--light-color);
    }

    .product-details {
        background: white;
        border-radius: 12px;
        padding: 2rem;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
    }

    .product-title {
        font-size: 2rem;
        font-weight: 700;
        color: var(--dark-color);
        margin-bottom: 1rem;
    }

    .product-category {
        display: inline-block;
        background: var(--light-color);
        color: var(--primary-color);
        padding: 0.5rem 1rem;
        border-radius: 50px;
        font-size: 0.9rem;
        font-weight: 600;
        margin-bottom: 1rem;
    }

    .product-rating {
        margin-bottom: 1.5rem;
    }

    .product-rating i {
        color: #ffc107;
    }

    .product-price-section {
        margin-bottom: 2rem;
        padding-bottom: 2rem;
        border-bottom: 1px solid var(--light-color);
    }

    .product-price {
        font-size: 2.5rem;
        color: var(--primary-color);
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .original-price {
        font-size: 1.2rem;
        color: #999;
        text-decoration: line-through;
        margin-right: 1rem;
    }

    .discount-badge {
        background: var(--primary-color);
        color: white;
        padding: 0.25rem 0.75rem;
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 600;
    }

    .product-stock-info {
        margin-bottom: 1.5rem;
        padding: 1rem;
        background: var(--light-color);
        border-radius: 8px;
    }

    .stock-status {
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .product-description {
        color: #555;
        line-height: 1.6;
        margin-bottom: 2rem;
    }

    .quantity-selector {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 2rem;
        max-width: 200px;
    }

    .quantity-selector input {
        width: 80px;
        text-align: center;
    }

    .btn-quantity {
        width: 40px;
        height: 40px;
        padding: 0;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .add-to-cart-section {
        display: flex;
        gap: 1rem;
        margin-bottom: 2rem;
    }

    .add-to-cart-section .btn {
        flex: 1;
        padding: 1rem;
        font-weight: 600;
        font-size: 1.05rem;
        height: auto;
    }

    .btn-cart {
        background: linear-gradient(135deg, var(--secondary-color) 0%, var(--primary-color) 100%);
        color: white;
    }

    .btn-wishlist {
        background: white;
        border: 2px solid var(--primary-color);
        color: var(--primary-color);
    }

    .related-products {
        margin-top: 4rem;
    }

    .product-benefits {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
        margin-top: 2rem;
    }

    .benefit-item {
        display: flex;
        align-items: start;
        gap: 1rem;
    }

    .benefit-icon {
        font-size: 1.5rem;
        color: var(--primary-color);
        margin-top: 0.25rem;
    }

    .benefit-text h6 {
        font-weight: 600;
        margin-bottom: 0.25rem;
    }

    .benefit-text p {
        font-size: 0.9rem;
        color: #666;
    }

    @media (max-width: 768px) {
        .product-gallery {
            height: 300px;
        }

        .product-title {
            font-size: 1.5rem;
        }

        .product-price {
            font-size: 1.8rem;
        }

        .add-to-cart-section {
            flex-direction: column;
        }
    }
</style>
@endsection

@section('content')
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Products</a></li>
            <li class="breadcrumb-item"><a href="{{ route('categories.show', $product->category->id) }}">{{ $product->category->name }}</a></li>
            <li class="breadcrumb-item active">{{ $product->name }}</li>
        </ol>
    </nav>

    <div class="row mb-5">
        <!-- Product Image -->
        <div class="col-lg-6 mb-4">
            <div class="product-gallery">
                @if($product->image_url)
                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}">
                @else
                    <div class="gallery-placeholder">
                        <div class="text-center">
                            <i class="fas fa-image fa-5x text-muted mb-3"></i>
                            <p class="text-muted">No image available</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Product Details -->
        <div class="col-lg-6">
            <div class="product-details">
                <span class="product-category">{{ $product->category->name }}</span>

                <h1 class="product-title">{{ $product->name }}</h1>

                <div class="product-rating">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                    <span class="ms-2 text-muted">(4.5 out of 5 - 128 reviews)</span>
                </div>

                <!-- Price Section -->
                <div class="product-price-section">
                    <div class="d-flex align-items-center mb-2">
                        <span class="product-price">₹{{ number_format($product->price, 2) }}</span>
                        <span class="discount-badge ms-2">Save 20%</span>
                    </div>
                    <small class="text-muted">
                        <i class="fas fa-leaf"></i> Fresh & Organic
                    </small>
                </div>

                <!-- Stock Info -->
                <div class="product-stock-info">
                    <div class="stock-status">
                        @if($product->isInStock())
                            <i class="fas fa-check-circle text-success"></i>
                            In Stock - {{ $product->stock }} available
                        @else
                            <i class="fas fa-times-circle text-danger"></i>
                            Out of Stock
                        @endif
                    </div>
                    <small class="text-muted">Free delivery on orders above ₹500</small>
                </div>

                <!-- Description -->
                <p class="product-description">
                    {{ $product->description ?? 'Premium quality ' . $product->name . ' sourced from the best farms. Fresh, organic, and delicious!' }}
                </p>

                <!-- Add to Cart -->
                @auth
                    <form action="{{ route('cart.add') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                        <div class="quantity-selector">
                            <button type="button" class="btn btn-quantity btn-outline-primary" onclick="decreaseQty()">
                                <i class="fas fa-minus"></i>
                            </button>
                            <input type="number" id="quantity" name="quantity" value="1" min="1" max="{{ $product->stock }}" class="form-control">
                            <button type="button" class="btn btn-quantity btn-outline-primary" onclick="increaseQty()">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>

                        <div class="add-to-cart-section">
                            @if($product->isInStock())
                                <button type="submit" class="btn btn-cart">
                                    <i class="fas fa-shopping-cart"></i> Add to Cart
                                </button>
                            @else
                                <button type="button" class="btn btn-secondary" disabled>
                                    <i class="fas fa-ban"></i> Out of Stock
                                </button>
                            @endif
                            <button type="button" class="btn btn-wishlist">
                                <i class="fas fa-heart"></i> Wishlist
                            </button>
                        </div>
                    </form>
                @else
                    <div class="alert alert-info mb-3">
                        <i class="fas fa-info-circle"></i> Please <a href="{{ route('login') }}">login</a> to add items to cart
                    </div>
                    <a href="{{ route('login') }}" class="btn btn-primary w-100 mb-3">
                        <i class="fas fa-sign-in-alt"></i> Login to Shop
                    </a>
                @endauth

                <!-- Product Benefits -->
                <div class="product-benefits">
                    <div class="benefit-item">
                        <div class="benefit-icon">
                            <i class="fas fa-truck"></i>
                        </div>
                        <div class="benefit-text">
                            <h6>Fast Delivery</h6>
                            <p>Delivered within 24 hours</p>
                        </div>
                    </div>
                    <div class="benefit-item">
                        <div class="benefit-icon">
                            <i class="fas fa-leaf"></i>
                        </div>
                        <div class="benefit-text">
                            <h6>100% Organic</h6>
                            <p>No pesticides or chemicals</p>
                        </div>
                    </div>
                    <div class="benefit-item">
                        <div class="benefit-icon">
                            <i class="fas fa-undo"></i>
                        </div>
                        <div class="benefit-text">
                            <h6>Easy Returns</h6>
                            <p>7-day return guarantee</p>
                        </div>
                    </div>
                    <div class="benefit-item">
                        <div class="benefit-icon">
                            <i class="fas fa-headset"></i>
                        </div>
                        <div class="benefit-text">
                            <h6>24/7 Support</h6>
                            <p>Dedicated customer service</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Products -->
    @if($relatedProducts->count() > 0)
        <div class="related-products">
            <div class="section-title">
                <h2>Related Products</h2>
            </div>

            <div class="row g-4">
                @foreach($relatedProducts as $relProduct)
                    <div class="col-md-6 col-lg-3">
                        <div class="card product-card h-100">
                            <div class="product-image">
                                @if($relProduct->image_url)
                                    <img src="{{ $relProduct->image_url }}" alt="{{ $relProduct->name }}" loading="lazy">
                                @else
                                    <div class="d-flex align-items-center justify-content-center h-100 bg-light">
                                        <i class="fas fa-image text-muted fa-3x"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="product-info">
                                <h5 class="product-name">{{ $relProduct->name }}</h5>
                                <div class="product-price">₹{{ number_format($relProduct->price, 2) }}</div>
                                <a href="{{ route('products.show', $relProduct->id) }}" class="btn btn-primary btn-sm w-100">
                                    <i class="fas fa-eye"></i> View
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
@endsection

@section('extra-js')
<script>
    function decreaseQty() {
        const qty = document.getElementById('quantity');
        if (qty.value > 1) {
            qty.value--;
        }
    }

    function increaseQty() {
        const qty = document.getElementById('quantity');
        const max = parseInt(qty.getAttribute('max'));
        if (qty.value < max) {
            qty.value++;
        }
    }
</script>
@endsection
