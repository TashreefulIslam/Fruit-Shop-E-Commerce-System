@extends('layouts.admin')

@section('title', 'Edit Product - Admin')

@section('content')
    <div class="page-header">
        <h1><i class="fas fa-edit"></i> Edit Product</h1>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="category_id" class="form-label">Category *</label>
                            <select class="form-select @error('category_id') is-invalid @enderror" id="category_id" name="category_id" required>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label">Product Name *</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $product->name }}" required>
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="price" class="form-label">Price *</label>
                            <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ $product->price }}" step="0.01" required>
                            @error('price')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="stock" class="form-label">Stock *</label>
                            <input type="number" class="form-control @error('stock') is-invalid @enderror" id="stock" name="stock" value="{{ $product->stock }}" required>
                            @error('stock')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4">{{ $product->description }}</textarea>
                            @error('description')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Product Image</label>
                            
                            @if($product->image_url)
                                <div class="mb-3">
                                    <p class="text-muted small"><strong>Current Image:</strong></p>
                                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" style="max-width: 200px; max-height: 200px; border-radius: 8px; border: 2px solid #dee2e6; object-fit: cover;">
                                </div>
                            @else
                                <p class="text-muted small mb-2"><em>No image uploaded</em></p>
                            @endif
                            
                            <div class="mb-2">
                                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*" onchange="previewNewImage(event)">
                                <small class="text-muted d-block mt-1">
                                    <i class="fas fa-info-circle"></i> Choose a new image file only if you want to replace the current one. Leave blank to keep it.
                                </small>
                            </div>

                            <div id="newImagePreview" style="display: none;">
                                <p class="text-muted small"><strong>New Image Preview:</strong></p>
                                <img id="previewImg" src="" alt="Preview" style="max-width: 200px; max-height: 200px; border-radius: 8px; border: 2px solid #28a745;">
                            </div>

                            @error('image')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Update Product
                            </button>
                            <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-times"></i> Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function previewNewImage(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('newImagePreview');
            const previewImg = document.getElementById('previewImg');

            if (file) {
                previewImg.src = URL.createObjectURL(file);
                preview.style.display = 'block';
            } else {
                preview.style.display = 'none';
                previewImg.src = '';
            }
        }
    </script>
@endsection
