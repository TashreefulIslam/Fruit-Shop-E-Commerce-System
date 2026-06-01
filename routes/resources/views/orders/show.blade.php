@extends('layouts.app')

@section('title', 'Order Details - Fruit Shop')

@section('extra-css')
<style>
    .detail-box {
        background: white;
        border-radius: 12px;
        padding: 2rem;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        margin-bottom: 2rem;
    }

    .section-header {
        border-bottom: 2px solid var(--light-color);
        padding-bottom: 1rem;
        margin-bottom: 1.5rem;
    }

    .section-header h5 {
        font-weight: 700;
        color: var(--dark-color);
    }

    .info-row {
        display: flex;
        justify-content: space-between;
        padding: 0.75rem 0;
        border-bottom: 1px solid var(--light-color);
    }

    .info-row:last-child {
        border-bottom: none;
    }

    .info-label {
        color: #666;
        font-weight: 600;
    }

    .info-value {
        color: var(--dark-color);
        font-weight: 500;
    }

    .status-badge {
        padding: 0.75rem 1.5rem;
        border-radius: 50px;
        font-weight: 700;
        display: inline-block;
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

    .order-item {
        display: flex;
        gap: 2rem;
        padding: 1.5rem;
        border-bottom: 1px solid var(--light-color);
        align-items: center;
    }

    .order-item:last-child {
        border-bottom: none;
    }

    .item-image {
        width: 100px;
        height: 100px;
        border-radius: 8px;
        overflow: hidden;
        background: var(--light-color);
    }

    .item-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .item-details {
        flex: 1;
    }

    .item-name {
        font-weight: 600;
        color: var(--dark-color);
        margin-bottom: 0.5rem;
    }

    .item-price {
        color: var(--primary-color);
        font-weight: 700;
    }

    .timeline {
        position: relative;
        padding: 1rem 0;
    }

    .timeline-item {
        display: flex;
        gap: 1.5rem;
        margin-bottom: 2rem;
        position: relative;
    }

    .timeline-item::before {
        content: '';
        position: absolute;
        left: 19px;
        top: 50px;
        width: 2px;
        height: 50px;
        background: var(--light-color);
    }

    .timeline-item:last-child::before {
        display: none;
    }

    .timeline-marker {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: var(--light-color);
        border: 3px solid var(--light-color);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #666;
        font-weight: 700;
        flex-shrink: 0;
        position: relative;
        z-index: 1;
    }

    .timeline-item.active .timeline-marker {
        background: var(--primary-color);
        border-color: var(--primary-color);
        color: white;
    }

    .timeline-content h6 {
        font-weight: 700;
        color: var(--dark-color);
        margin-bottom: 0.25rem;
    }

    .timeline-content p {
        color: #666;
        font-size: 0.9rem;
    }

    @media (max-width: 768px) {
        .order-item {
            flex-wrap: wrap;
            gap: 1rem;
        }

        .info-row {
            flex-direction: column;
            gap: 0.5rem;
        }
    }
</style>
@endsection

@section('content')
    <div class="mb-4">
        <a href="{{ route('orders.index') }}" class="btn btn-outline-primary mb-3">
            <i class="fas fa-arrow-left"></i> Back to Orders
        </a>
        <h1 class="mb-2">Order #{{ $order->id }}</h1>
        <p class="text-muted">{{ $order->created_at->format('d M Y, H:i A') }}</p>
    </div>

    <div class="row">
        <!-- Order Details -->
        <div class="col-lg-8">
            <!-- Status -->
            <div class="detail-box">
                <div class="section-header">
                    <h5><i class="fas fa-info-circle"></i> Order Status</h5>
                </div>
                <div class="mb-3">
                    <span class="status-badge status-{{ strtolower($order->status) }}">
                        {{ $order->status }}
                    </span>
                </div>
                <p class="text-muted">
                    @if($order->status === 'Pending')
                        Your order is awaiting confirmation. We'll process it shortly.
                    @elseif($order->status === 'Processing')
                        Your order is being prepared for dispatch.
                    @elseif($order->status === 'Delivered')
                        Your order has been delivered successfully.
                    @endif
                </p>
            </div>

            <!-- Order Timeline -->
            <div class="detail-box">
                <div class="section-header">
                    <h5><i class="fas fa-tasks"></i> Order Timeline</h5>
                </div>
                
                <div class="timeline">
                    <div class="timeline-item {{ $order->status === 'Pending' || $order->status === 'Processing' || $order->status === 'Delivered' ? 'active' : '' }}">
                        <div class="timeline-marker"><i class="fas fa-check"></i></div>
                        <div class="timeline-content">
                            <h6>Order Placed</h6>
                            <p>{{ $order->created_at->format('d M Y, H:i A') }}</p>
                        </div>
                    </div>

                    <div class="timeline-item {{ $order->status === 'Processing' || $order->status === 'Delivered' ? 'active' : '' }}">
                        <div class="timeline-marker"><i class="fas fa-box"></i></div>
                        <div class="timeline-content">
                            <h6>Processing</h6>
                            <p>Your order is being prepared</p>
                        </div>
                    </div>

                    <div class="timeline-item {{ $order->status === 'Delivered' ? 'active' : '' }}">
                        <div class="timeline-marker"><i class="fas fa-truck"></i></div>
                        <div class="timeline-content">
                            <h6>Shipped</h6>
                            <p>Your order is on the way</p>
                        </div>
                    </div>

                    <div class="timeline-item {{ $order->status === 'Delivered' ? 'active' : '' }}">
                        <div class="timeline-marker"><i class="fas fa-check-circle"></i></div>
                        <div class="timeline-content">
                            <h6>Delivered</h6>
                            <p>Order delivered successfully</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Items -->
            <div class="detail-box">
                <div class="section-header">
                    <h5><i class="fas fa-shopping-bag"></i> Order Items</h5>
                </div>

                @foreach($order->items as $item)
                    <div class="order-item">
                        <div class="item-image">
                            @if($item->product->image)
                                <img src="{{ $item->product->image_url }}" alt="{{ $item->product->name }}">
                            @else
                                <div class="d-flex align-items-center justify-content-center h-100">
                                    <i class="fas fa-image text-muted"></i>
                                </div>
                            @endif
                        </div>
                        <div class="item-details">
                            <div class="item-name">{{ $item->product->name }}</div>
                            <small class="text-muted">{{ $item->product->category->name }}</small>
                            <div class="item-price mt-2">₹{{ number_format($item->price, 2) }} x {{ $item->quantity }}</div>
                        </div>
                        <div class="text-end">
                            <div class="fw-700 text-dark">₹{{ number_format($item->price * $item->quantity, 2) }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Summary Sidebar -->
        <div class="col-lg-4">
            <!-- Delivery Information -->
            <div class="detail-box">
                <div class="section-header">
                    <h5><i class="fas fa-map-marker-alt"></i> Delivery Information</h5>
                </div>

                <div class="info-row">
                    <span class="info-label">Name</span>
                    <span class="info-value">{{ $order->user->name }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Email</span>
                    <span class="info-value">{{ $order->user->email }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Phone</span>
                    <span class="info-value">{{ $order->phone }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Address</span>
                    <span class="info-value">{{ $order->address }}</span>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="detail-box">
                <div class="section-header">
                    <h5><i class="fas fa-calculator"></i> Order Summary</h5>
                </div>

                <div class="info-row">
                    <span class="info-label">Subtotal</span>
                    <span class="info-value">₹{{ number_format($order->total_price, 2) }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Shipping</span>
                    <span class="info-value">{{ $order->total_price >= 500 ? 'FREE' : '₹100' }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Tax (18%)</span>
                    <span class="info-value">₹{{ number_format($order->total_price * 0.18, 2) }}</span>
                </div>
                <div class="info-row" style="font-size: 1.2rem; font-weight: 700; color: var(--primary-color);">
                    <span>Total</span>
                    <span>₹{{ number_format($order->total_price + ($order->total_price * 0.18) + ($order->total_price >= 500 ? 0 : 100), 2) }}</span>
                </div>
            </div>

            <!-- Items Count -->
            <div class="detail-box bg-light">
                <div class="info-row">
                    <span class="info-label"><i class="fas fa-cube"></i> Total Items</span>
                    <span class="info-value">{{ $order->items->sum('quantity') }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label"><i class="fas fa-calendar"></i> Order Date</span>
                    <span class="info-value">{{ $order->created_at->format('d M Y') }}</span>
                </div>
            </div>

            <!-- Actions -->
            <a href="{{ route('orders.index') }}" class="btn btn-primary w-100">
                <i class="fas fa-arrow-left"></i> Back to Orders
            </a>
            @if($order->status === 'Delivered')
                <a href="{{ route('products.index') }}" class="btn btn-outline-primary w-100 mt-2">
                    <i class="fas fa-shopping-bag"></i> Order Again
                </a>
            @endif
        </div>
    </div>
@endsection
