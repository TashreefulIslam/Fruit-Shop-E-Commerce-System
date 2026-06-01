@extends('layouts.app')

@section('title', 'Order Placed - Fruit Shop')

@section('extra-css')
<style>
    .success-container {
        text-align: center;
        padding: 4rem 2rem;
        background: white;
        border-radius: 12px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
    }

    .success-icon {
        font-size: 5rem;
        color: #28a745;
        margin-bottom: 1rem;
        animation: scaleIn 0.5s ease;
    }

    @keyframes scaleIn {
        from {
            transform: scale(0);
        }
        to {
            transform: scale(1);
        }
    }

    .success-title {
        font-size: 2rem;
        font-weight: 700;
        color: var(--dark-color);
        margin-bottom: 1rem;
    }

    .success-message {
        color: #666;
        font-size: 1.1rem;
        margin-bottom: 2rem;
    }

    .order-details-box {
        background: var(--light-color);
        border-radius: 8px;
        padding: 2rem;
        margin: 2rem 0;
        text-align: left;
    }

    .detail-row {
        display: flex;
        justify-content: space-between;
        padding: 0.75rem 0;
        border-bottom: 1px solid #ddd;
    }

    .detail-row:last-child {
        border-bottom: none;
    }

    .detail-label {
        color: #666;
        font-weight: 600;
    }

    .detail-value {
        color: var(--dark-color);
        font-weight: 700;
    }

    .next-steps {
        background: white;
        border-radius: 8px;
        padding: 2rem;
        margin-top: 2rem;
        text-align: left;
    }

    .step {
        display: flex;
        gap: 1.5rem;
        margin-bottom: 1.5rem;
    }

    .step-number {
        background: var(--primary-color);
        color: white;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        flex-shrink: 0;
    }

    .step-content h6 {
        font-weight: 700;
        color: var(--dark-color);
        margin-bottom: 0.25rem;
    }

    .step-content p {
        color: #666;
        font-size: 0.95rem;
    }

    .action-buttons {
        display: flex;
        gap: 1rem;
        justify-content: center;
        flex-wrap: wrap;
        margin-top: 2rem;
    }

    .action-buttons .btn {
        padding: 0.75rem 2rem;
        font-weight: 600;
    }
</style>
@endsection

@section('content')
    <div class="success-container">
        <div class="success-icon">
            <i class="fas fa-check-circle"></i>
        </div>

        <h1 class="success-title">Order Placed Successfully!</h1>
        <p class="success-message">Thank you for your purchase. Your order has been confirmed.</p>

        <!-- Order Details -->
        <div class="order-details-box">
            <div class="detail-row">
                <span class="detail-label"><i class="fas fa-receipt"></i> Order ID:</span>
                <span class="detail-value">#{{ $order->id }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label"><i class="fas fa-calendar"></i> Order Date:</span>
                <span class="detail-value">{{ $order->created_at->format('d M Y, H:i A') }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label"><i class="fas fa-home"></i> Delivery Address:</span>
                <span class="detail-value">{{ $order->address }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label"><i class="fas fa-phone"></i> Contact:</span>
                <span class="detail-value">{{ $order->phone }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label"><i class="fas fa-box"></i> Total Items:</span>
                <span class="detail-value">{{ $order->items->sum('quantity') }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label"><i class="fas fa-tag"></i> Total Amount:</span>
                <span class="detail-value">₹{{ number_format($order->total_price, 2) }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label"><i class="fas fa-info-circle"></i> Status:</span>
                <span class="detail-value">
                    <span class="badge bg-warning">{{ $order->status }}</span>
                </span>
            </div>
        </div>

        <!-- Order Items -->
        <div class="next-steps">
            <h5 class="mb-3"><i class="fas fa-bag-shopping"></i> Order Items</h5>
            <table class="table table-sm">
                <tbody>
                    @foreach($order->items as $item)
                        <tr>
                            <td>{{ $item->product->name }}</td>
                            <td class="text-center">{{ $item->quantity }}</td>
                            <td class="text-end">₹{{ number_format($item->price, 2) }}</td>
                            <td class="text-end"><strong>₹{{ number_format($item->price * $item->quantity, 2) }}</strong></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Next Steps -->
        <div class="next-steps">
            <h5 class="mb-3"><i class="fas fa-tasks"></i> What Happens Next?</h5>
            
            <div class="step">
                <div class="step-number">1</div>
                <div class="step-content">
                    <h6>Order Confirmation</h6>
                    <p>You'll receive a confirmation email shortly with your order details and tracking information.</p>
                </div>
            </div>

            <div class="step">
                <div class="step-number">2</div>
                <div class="step-content">
                    <h6>Processing</h6>
                    <p>Our team will prepare and pack your order with care for safe delivery.</p>
                </div>
            </div>

            <div class="step">
                <div class="step-number">3</div>
                <div class="step-content">
                    <h6>Dispatch</h6>
                    <p>Your order will be dispatched within 24 hours. You'll receive tracking updates.</p>
                </div>
            </div>

            <div class="step">
                <div class="step-number">4</div>
                <div class="step-content">
                    <h6>Delivery</h6>
                    <p>Your products will be delivered within 3-5 business days as per your location.</p>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="action-buttons">
            <a href="{{ route('orders.show', $order->id) }}" class="btn btn-primary">
                <i class="fas fa-eye"></i> View Order Details
            </a>
            <a href="{{ route('orders.index') }}" class="btn btn-outline-primary">
                <i class="fas fa-history"></i> My Orders
            </a>
            <a href="{{ route('products.index') }}" class="btn btn-outline-primary">
                <i class="fas fa-shopping-bag"></i> Continue Shopping
            </a>
        </div>
    </div>
@endsection
