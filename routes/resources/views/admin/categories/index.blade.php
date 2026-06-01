@extends('layouts.admin')

@section('title', 'Manage Categories - Admin')

@section('content')
    <div class="page-header">
        <h1><i class="fas fa-list"></i> Categories</h1>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add Category
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            @if($categories->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Products</th>
                                <th>Created</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td><strong>#{{ $category->id }}</strong></td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ Str::limit($category->description ?? 'N/A', 50) }}</td>
                                    <td><span class="badge bg-info">{{ $category->products_count }}</span></td>
                                    <td>{{ $category->created_at->format('d M Y') }}</td>
                                    <td>
                                        <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" style="display:inline;">
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
                {{ $categories->links() }}
            @else
                <div class="text-center py-5">
                    <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                    <p class="text-muted">No categories found</p>
                    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Create First Category
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection
