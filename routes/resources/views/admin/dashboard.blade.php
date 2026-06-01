@extends('layouts.admin')

@section('title', 'Admin Dashboard - Fruit Shop')

@section('content')
    <div class="page-header">
        <div>
            <h1><i class="fas fa-tachometer-alt"></i> Dashboard</h1>
            <p class="text-muted">Welcome back, {{ auth()->user()->name }}!</p>
        </div>
        <div>
            <span class="badge bg-primary" style="padding: 0.5rem 1rem; font-size: 0.95rem;">
                {{ now()->format('d M Y') }}
            </span>
        </div>
    </div>

    <!-- Stats Row -->
    <div class="row mb-4">
        <div class="col-md-6 col-lg-3">
            <div class="stat-box">
                <div class="stat-icon"><i class="fas fa-users"></i></div>
                <div class="stat-value">{{ $totalUsers }}</div>
                <div class="stat-label">Total Customers</div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="stat-box" style="border-left-color: #28a745;">
                <div class="stat-icon" style="color: #28a745;"><i class="fas fa-box"></i></div>
                <div class="stat-value">{{ $totalProducts }}</div>
                <div class="stat-label">Total Products</div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="stat-box" style="border-left-color: #ffc107;">
                <div class="stat-icon" style="color: #ffc107;"><i class="fas fa-shopping-cart"></i></div>
                <div class="stat-value">{{ $totalOrders }}</div>
                <div class="stat-label">Total Orders</div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="stat-box" style="border-left-color: #17a2b8;">
                <div class="stat-icon" style="color: #17a2b8;"><i class="fas fa-rupee-sign"></i></div>
                <div class="stat-value">₹{{ number_format($totalRevenue, 0) }}</div>
                <div class="stat-label">Total Revenue</div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Recent Orders -->
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header bg-white border-bottom">
                    <h5 class="mb-0"><i class="fas fa-list"></i> Recent Orders</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Customer</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentOrders as $order)
                                    <tr>
                                        <td><strong>#{{ $order->id }}</strong></td>
                                        <td>{{ $order->user->name }}</td>
                                        <td>₹{{ number_format($order->total_price, 2) }}</td>
                                        <td>
                                            <span class="badge 
                                                @if($order->status === 'Pending') bg-warning
                                                @elseif($order->status === 'Processing') bg-info
                                                @else bg-success
                                                @endif">
                                                {{ $order->status }}
                                            </span>
                                        </td>
                                        <td>{{ $order->created_at->format('d M Y') }}</td>
                                        <td>
                                            <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-primary">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-4 text-muted">No orders yet</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Low Stock Products -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header bg-white border-bottom">
                    <h5 class="mb-0"><i class="fas fa-exclamation-triangle"></i> Low Stock Alert</h5>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        @forelse($lowStockProducts as $product)
                            <a href="{{ route('admin.products.edit', $product->id) }}" class="list-group-item list-group-item-action">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong>{{ $product->name }}</strong>
                                        <br>
                                        <small class="text-muted">{{ $product->category->name }}</small>
                                    </div>
                                    <span class="badge bg-danger">{{ $product->stock }} left</span>
                                </div>
                            </a>
                        @empty
                            <div class="p-3 text-center text-muted">
                                <i class="fas fa-check-circle" style="font-size: 2rem; opacity: 0.5;"></i>
                                <p class="mt-2">All products are well stocked!</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="card mt-4">
                <div class="card-header bg-white border-bottom">
                    <h5 class="mb-0"><i class="fas fa-info-circle"></i> Quick Stats</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label mb-1">Categories</label>
                        <div style="font-size: 1.5rem; font-weight: 700; color: var(--primary-color);">
                            {{ $totalCategories }}
                        </div>
                    </div>
                    <hr>
                    <div>
                        <label class="form-label mb-1">Avg Order Value</label>
                        <div style="font-size: 1.5rem; font-weight: 700; color: var(--primary-color);">
                            ₹{{ $totalOrders > 0 ? number_format($totalRevenue / $totalOrders, 0) : 0 }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="card mt-4">
        <div class="card-header bg-white border-bottom">
            <h5 class="mb-0"><i class="fas fa-bolt"></i> Quick Actions</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3 mb-3">
                    <a href="{{ route('admin.categories.create') }}" class="btn btn-outline-primary w-100">
                        <i class="fas fa-plus"></i> Add Category
                    </a>
                </div>
                <div class="col-md-3 mb-3">
                    <a href="{{ route('admin.products.create') }}" class="btn btn-outline-primary w-100">
                        <i class="fas fa-plus"></i> Add Product
                    </a>
                </div>
                <div class="col-md-3 mb-3">
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-primary w-100">
                        <i class="fas fa-list"></i> View Orders
                    </a>
                </div>
                <div class="col-md-3 mb-3">
                    <a href="{{ route('admin.products.index') }}" class="btn btn-outline-primary w-100">
                        <i class="fas fa-edit"></i> Edit Products
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
