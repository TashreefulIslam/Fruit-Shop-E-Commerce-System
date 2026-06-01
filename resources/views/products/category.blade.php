@extends('layouts.app')

@section('title', $category->name . ' Products - Fruit Shop')

@section('content')
    <div class="mb-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active">{{ $category->name }}</li>
            </ol>
        </nav>

        <h1 class="mb-3">{{ $category->name }} Products</h1>
        <p class="text-muted">{{ $products->total() }} products found</p>
    </div>

    <div class="row">
        <!-- Sidebar -->
        <div class="col-lg-3 mb-4">
            <div class="bg-white p-4 rounded" style="box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);">
                <h5 class="mb-3">
                    <i class="fas fa-list"></i> Categories
                </h5>
                @foreach($categories as $cat)
                    <a href="{{ route('categories.show', $cat->id) }}" 
                       class="d-block py-2 {{ $cat->id == $category->id ? 'text-primary fw-bold' : 'text-decoration-none text-dark' }}"
                       style="transition: all 0.3s ease;">
                        {{ $cat->name }}
                        <span class="badge bg-light text-dark float-end">{{ $cat->products->count() }}</span>
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Products -->
        <div class="col-lg-9">
            @if($products->count() > 0)
                <div class="row g-4 mb-4">
                    @foreach($products as $product)
                        <div class="col-md-6 col-lg-4">
                            <div class="card product-card h-100">
                                <div class="product-image">
                                    @if($product->image_url)
                                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" loading="lazy">
                                    @else
                                        <div class="d-flex align-items-center justify-content-center h-100 bg-light">
                                            <i class="fas fa-image text-muted fa-3x"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="product-info">
                                    <h5 class="product-name">{{ $product->name }}</h5>
                                    <div class="product-price">₹{{ number_format($product->price, 2) }}</div>
                                    <div class="product-stock">
                                        @if($product->isInStock())
                                            <span class="badge bg-success">In Stock</span>
                                        @else
                                            <span class="badge bg-danger">Out of Stock</span>
                                        @endif
                                    </div>
                                    <a href="{{ route('products.show', $product->id) }}" class="btn btn-primary btn-sm w-100">
                                        <i class="fas fa-eye"></i> View Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center">
                    {{ $products->links() }}
                </div>
            @else
                <div class="empty-state">
                    <i class="fas fa-inbox"></i>
                    <p>No products in this category</p>
                    <a href="{{ route('products.index') }}" class="btn btn-primary">View All Products</a>
                </div>
            @endif
        </div>
    </div>
@endsection
