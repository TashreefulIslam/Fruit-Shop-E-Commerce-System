@extends('layouts.admin')

@section('title', 'Order Details - Admin')

@section('content')
    <div class="page-header">
        <h1><i class="fas fa-receipt"></i> Order #{{ $order->id }}</h1>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <!-- Order Items -->
            <div class="card mb-4">
                <div class="card-header bg-white border-bottom">
                    <h5 class="mb-0"><i class="fas fa-box"></i> Order Items</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->items as $item)
                                    <tr>
                                        <td>{{ $item->product->name }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>₹{{ number_format($item->price, 2) }}</td>
                                        <td><strong>₹{{ number_format($item->price * $item->quantity, 2) }}</strong></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Update Status -->
            <div class="card">
                <div class="card-header bg-white border-bottom">
                    <h5 class="mb-0"><i class="fas fa-sync-alt"></i> Update Status</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label for="status" class="form-label">Order Status</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="Pending" {{ $order->status === 'Pending' ? 'selected' : '' }}>Pending</option>
                                <option value="Processing" {{ $order->status === 'Processing' ? 'selected' : '' }}>Processing</option>
                                <option value="Delivered" {{ $order->status === 'Delivered' ? 'selected' : '' }}>Delivered</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Update Status
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Customer & Order Info -->
        <div class="col-lg-4">
            <!-- Customer Info -->
            <div class="card mb-4">
                <div class="card-header bg-white border-bottom">
                    <h5 class="mb-0"><i class="fas fa-user"></i> Customer Info</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <strong>Name</strong>
                        <p>{{ $order->user->name }}</p>
                    </div>
                    <div class="mb-3">
                        <strong>Email</strong>
                        <p>{{ $order->user->email }}</p>
                    </div>
                    <div class="mb-3">
                        <strong>Phone</strong>
                        <p>{{ $order->phone }}</p>
                    </div>
                </div>
            </div>

            <!-- Delivery Info -->
            <div class="card mb-4">
                <div class="card-header bg-white border-bottom">
                    <h5 class="mb-0"><i class="fas fa-map-marker-alt"></i> Delivery Address</h5>
                </div>
                <div class="card-body">
                    {{ $order->address }}
                </div>
            </div>

            <!-- Order Summary -->
            <div class="card">
                <div class="card-header bg-white border-bottom">
                    <h5 class="mb-0"><i class="fas fa-calculator"></i> Summary</h5>
                </div>
                <div class="card-body">
                    <div class="mb-2 d-flex justify-content-between">
                        <span>Subtotal:</span>
                        <strong>₹{{ number_format($order->total_price, 2) }}</strong>
                    </div>
                    <div class="mb-2 d-flex justify-content-between">
                        <span>Tax (18%):</span>
                        <strong>₹{{ number_format($order->total_price * 0.18, 2) }}</strong>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between" style="font-size: 1.2rem; font-weight: 700;">
                        <span>Total:</span>
                        <strong>₹{{ number_format($order->total_price + ($order->total_price * 0.18), 2) }}</strong>
                    </div>

                    <div class="mt-3">
                        <span class="badge 
                            @if($order->status === 'Pending') bg-warning
                            @elseif($order->status === 'Processing') bg-info
                            @else bg-success
                            @endif" 
                            style="font-size: 1rem;">
                            {{ $order->status }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
