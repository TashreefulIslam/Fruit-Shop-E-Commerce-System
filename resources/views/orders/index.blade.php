@extends('layouts.app')

@section('title', 'My Orders - Fruit Shop')

@section('extra-css')
<style>
    .order-card {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        margin-bottom: 1.5rem;
        border-left: 4px solid var(--primary-color);
        transition: all 0.3s ease;
    }

    .order-card:hover {
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
    }

    .order-header {
        display: flex;
        justify-content: space-between;
        align-items: start;
        margin-bottom: 1rem;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .order-id {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--dark-color);
    }

    .order-status {
        padding: 0.5rem 1rem;
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 600;
    }

    .status-pending {
        background: #fff3cd;
        color: #856404;
    }

    .status-processing {
        background: #d1ecf1;
        color: #0c5460;
    }

    .status-delivered {
        background: #d4edda;
        color: #155724;
    }

    .order-details {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
        margin-bottom: 1rem;
    }

    .detail {
        color: #666;
    }

    .detail-label {
        font-weight: 600;
        color: var(--dark-color);
        display: block;
        margin-bottom: 0.25rem;
    }

    .detail-value {
        color: #999;
        font-size: 0.95rem;
    }

    .order-items {
        background: var(--light-color);
        border-radius: 8px;
        padding: 1rem;
        margin-bottom: 1rem;
    }

    .item {
        display: flex;
        justify-content: space-between;
        padding: 0.5rem 0;
        border-bottom: 1px solid #ddd;
    }

    .item:last-child {
        border-bottom: none;
    }

    .item-name {
        color: var(--dark-color);
        font-weight: 500;
    }

    .item-qty {
        color: #999;
        margin: 0 1rem;
    }

    .item-price {
        color: var(--primary-color);
        font-weight: 600;
    }

    .order-actions {
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
    }

    .order-actions .btn {
        font-size: 0.9rem;
        padding: 0.4rem 0.8rem;
    }

    .empty-orders {
        text-align: center;
        padding: 3rem 1rem;
    }

    .empty-orders i {
        font-size: 4rem;
        color: #ccc;
        margin-bottom: 1rem;
    }

    .empty-orders p {
        color: #999;
        font-size: 1.1rem;
    }
</style>
@endsection

@section('content')
    <div class="mb-4">
        <h1 class="mb-2">
            <i class="fas fa-history"></i> My Orders
        </h1>
        <p class="text-muted">View and manage your orders</p>
    </div>

    @if($orders->count() > 0)
        @foreach($orders as $order)
            <div class="order-card">
                <!-- Order Header -->
                <div class="order-header">
                    <div>
                        <div class="order-id">Order #{{ $order->id }}</div>
                        <small class="text-muted">{{ $order->created_at->format('d M Y, H:i A') }}</small>
                    </div>
                    <span class="order-status status-{{ strtolower($order->status) }}">
                        {{ $order->status }}
                    </span>
                </div>

                <!-- Order Details Grid -->
                <div class="order-details">
                    <div class="detail">
                        <span class="detail-label"><i class="fas fa-box"></i> Items</span>
                        <span class="detail-value">{{ $order->items->sum('quantity') }} product(s)</span>
                    </div>
                    <div class="detail">
                        <span class="detail-label"><i class="fas fa-tag"></i> Total Amount</span>
                        <span class="detail-value">₹{{ number_format($order->total_price, 2) }}</span>
                    </div>
                    <div class="detail">
                        <span class="detail-label"><i class="fas fa-map-marker-alt"></i> Delivery Address</span>
                        <span class="detail-value">{{ substr($order->address, 0, 40) }}...</span>
                    </div>
                    <div class="detail">
                        <span class="detail-label"><i class="fas fa-phone"></i> Contact</span>
                        <span class="detail-value">{{ $order->phone }}</span>
                    </div>
                </div>

                <!-- Order Items Preview -->
                <div class="order-items">
                    <strong class="d-block mb-2">Items</strong>
                    @foreach($order->items as $item)
                        <div class="item">
                            <span class="item-name">{{ $item->product->name }}</span>
                            <span class="item-qty">x{{ $item->quantity }}</span>
                            <span class="item-price">₹{{ number_format($item->price, 2) }}</span>
                        </div>
                    @endforeach
                </div>

                <!-- Actions -->
                <div class="order-actions">
                    <a href="{{ route('orders.show', $order->id) }}" class="btn btn-primary">
                        <i class="fas fa-eye"></i> View Details
                    </a>
                    @if($order->status === 'Delivered')
                        <a href="#" class="btn btn-outline-primary">
                            <i class="fas fa-redo"></i> Return
                        </a>
                    @endif
                    @if($order->status === 'Processing' || $order->status === 'Pending')
                        <button class="btn btn-outline-danger" onclick="return confirm('Are you sure?')">
                            <i class="fas fa-times"></i> Cancel
                        </button>
                    @endif
                </div>
            </div>
        @endforeach

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $orders->links() }}
        </div>
    @else
        <div class="bg-white rounded p-5">
            <div class="empty-orders">
                <i class="fas fa-inbox"></i>
                <p>You haven't placed any orders yet</p>
                <a href="{{ route('products.index') }}" class="btn btn-primary mt-3">
                    <i class="fas fa-shopping-bag"></i> Start Shopping
                </a>
            </div>
        </div>
    @endif
@endsection
