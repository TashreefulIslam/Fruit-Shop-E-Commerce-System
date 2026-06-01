@extends('layouts.admin')

@section('title', 'Manage Products - Admin')

@section('content')
    <div class="page-header">
        <h1><i class="fas fa-box"></i> Products</h1>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add Product
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            @if($products->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Stock</th>
                                <th>Created</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td><strong>#{{ $product->id }}</strong></td>
                                    <td>
                                        @if($product->image_url)
                                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" style="width: 40px; height: 40px; object-fit: cover; border-radius: 4px;">
                                        @else
                                            <span class="text-muted">No image</span>
                                        @endif
                                    </td>
                                    <td>{{ Str::limit($product->name, 30) }}</td>
                                    <td><span class="badge bg-info">{{ $product->category->name }}</span></td>
                                    <td>₹{{ number_format($product->price, 2) }}</td>
                                    <td>
                                        @if($product->stock < 5)
                                            <span class="badge bg-danger">{{ $product->stock }}</span>
                                        @elseif($product->stock < 20)
                                            <span class="badge bg-warning">{{ $product->stock }}</span>
                                        @else
                                            <span class="badge bg-success">{{ $product->stock }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $product->created_at->format('d M Y') }}</td>
                                    <td>
                                        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $products->links() }}
            @else
                <div class="text-center py-5">
                    <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                    <p class="text-muted">No products found</p>
                    <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Create First Product
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection
