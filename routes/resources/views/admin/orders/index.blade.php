@extends('layouts.admin')

@section('title', 'Manage Orders - Admin')

@section('content')
    <div class="page-header">
        <h1><i class="fas fa-shopping-cart"></i> Orders</h1>
    </div>

    <div class="card">
        <div class="card-body">
            @if($orders->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Customer</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Items</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
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
                                    <td><span class="badge bg-light text-dark">{{ $order->items->sum('quantity') }}</span></td>
                                    <td>{{ $order->created_at->format('d M Y') }}</td>
                                    <td>
                                        <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $orders->links() }}
            @else
                <div class="text-center py-5">
                    <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                    <p class="text-muted">No orders found</p>
                </div>
            @endif
        </div>
    </div>
@endsection
