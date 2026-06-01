

<?php $__env->startSection('title', 'Checkout - Fruit Shop'); ?>

<?php $__env->startSection('extra-css'); ?>
<style>
    .checkout-container {
        background: white;
        border-radius: 12px;
        padding: 2rem;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
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

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-group label {
        font-weight: 600;
        color: var(--dark-color);
        margin-bottom: 0.5rem;
    }

    .order-items {
        background: var(--light-color);
        border-radius: 8px;
        padding: 1.5rem;
        margin-bottom: 2rem;
    }

    .order-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-bottom: 1rem;
        margin-bottom: 1rem;
        border-bottom: 1px solid #ddd;
    }

    .order-item:last-child {
        border-bottom: none;
        padding-bottom: 0;
        margin-bottom: 0;
    }

    .item-info {
        flex: 1;
    }

    .item-name {
        font-weight: 600;
        color: var(--dark-color);
    }

    .item-quantity {
        color: #999;
        font-size: 0.9rem;
    }

    .item-price {
        font-weight: 700;
        color: var(--primary-color);
    }

    .order-summary {
        background: linear-gradient(135deg, var(--secondary-color) 0%, var(--primary-color) 100%);
        color: white;
        border-radius: 12px;
        padding: 2rem;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        position: sticky;
        top: 100px;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 1rem;
        font-size: 1.05rem;
    }

    .summary-row.total {
        border-top: 2px solid rgba(255, 255, 255, 0.2);
        padding-top: 1rem;
        margin-top: 1rem;
        font-size: 1.3rem;
        font-weight: 700;
    }

    .address-input {
        min-height: 100px;
    }

    .payment-method {
        background: var(--light-color);
        border-radius: 8px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
    }

    .payment-option {
        display: flex;
        align-items: center;
        padding: 1rem;
        background: white;
        border-radius: 8px;
        margin-bottom: 1rem;
        cursor: pointer;
        border: 2px solid #e0e0e0;
        transition: all 0.3s ease;
    }

    .payment-option:hover {
        border-color: var(--primary-color);
        background: rgba(255, 107, 53, 0.05);
    }

    .payment-option input[type="radio"] {
        margin-right: 1rem;
    }

    .security-info {
        background: #d4edda;
        border-left: 4px solid #28a745;
        padding: 1rem;
        border-radius: 6px;
        margin-top: 1.5rem;
    }

    @media (max-width: 768px) {
        .order-summary {
            position: static;
        }

        .order-item {
            flex-direction: column;
            align-items: flex-start;
            gap: 0.5rem;
        }
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="mb-4">
        <h1 class="mb-2">
            <i class="fas fa-credit-card"></i> Checkout
        </h1>
        <p class="text-muted">Complete your purchase</p>
    </div>

    <form action="<?php echo e(route('order.place')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <div class="row">
            <!-- Checkout Form -->
            <div class="col-lg-8">
                <!-- Delivery Information -->
                <div class="checkout-container mb-4">
                    <div class="section-header">
                        <h5><i class="fas fa-map-marker-alt"></i> Delivery Information</h5>
                    </div>

                    <div class="form-group">
                        <label for="name">Full Name *</label>
                        <input type="text" class="form-control" id="name" value="<?php echo e(auth()->user()->name); ?>" disabled>
                        <small class="text-muted">Your account name will be used</small>
                    </div>

                    <div class="form-group">
                        <label for="email">Email *</label>
                        <input type="email" class="form-control" id="email" value="<?php echo e(auth()->user()->email); ?>" disabled>
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone Number *</label>
                        <input type="tel" class="form-control <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="phone" name="phone" placeholder="Enter your phone number" required>
                        <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <small class="text-danger"><?php echo e($message); ?></small>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="form-group">
                        <label for="address">Delivery Address *</label>
                        <textarea class="form-control address-input <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="address" name="address" placeholder="Enter your complete delivery address" required></textarea>
                        <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <small class="text-danger"><?php echo e($message); ?></small>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                <!-- Order Items -->
                <div class="checkout-container mb-4">
                    <div class="section-header">
                        <h5><i class="fas fa-box"></i> Order Items</h5>
                    </div>

                    <div class="order-items">
                        <?php $__currentLoopData = $cartItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="order-item">
                                <div class="item-info">
                                    <div class="item-name"><?php echo e($item->product->name); ?></div>
                                    <div class="item-quantity">Quantity: <?php echo e($item->quantity); ?></div>
                                </div>
                                <div class="item-price">
                                    ₹<?php echo e(number_format($item->product->price * $item->quantity, 2)); ?>

                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>

                <!-- Shipping Method -->
                <div class="checkout-container mb-4">
                    <div class="section-header">
                        <h5><i class="fas fa-truck"></i> Shipping Method</h5>
                    </div>

                    <div class="payment-option">
                        <input type="radio" name="shipping" value="standard" checked>
                        <div>
                            <div class="fw-600">Standard Delivery</div>
                            <small class="text-muted">Delivery in 3-5 business days</small>
                            <div class="fw-700 text-primary">₹100</div>
                        </div>
                    </div>

                    <div class="payment-option">
                        <input type="radio" name="shipping" value="express">
                        <div>
                            <div class="fw-600">Express Delivery</div>
                            <small class="text-muted">Delivery in 1-2 business days</small>
                            <div class="fw-700 text-primary">₹250</div>
                        </div>
                    </div>

                    <?php if($total >= 500): ?>
                        <div class="alert alert-success">
                            <i class="fas fa-gift"></i> Free shipping available on orders above ₹500!
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Payment Method -->
                <div class="checkout-container">
                    <div class="section-header">
                        <h5><i class="fas fa-wallet"></i> Payment Method</h5>
                    </div>

                    <div class="payment-option">
                        <input type="radio" name="payment_method" value="cod" checked>
                        <div>
                            <div class="fw-600">Cash on Delivery</div>
                            <small class="text-muted">Pay when you receive your order</small>
                        </div>
                    </div>

                    <div class="payment-option">
                        <input type="radio" name="payment_method" value="card">
                        <div>
                            <div class="fw-600">Credit/Debit Card</div>
                            <small class="text-muted">Secure online payment</small>
                        </div>
                    </div>

                    <div class="payment-option">
                        <input type="radio" name="payment_method" value="upi">
                        <div>
                            <div class="fw-600">UPI</div>
                            <small class="text-muted">Quick and secure UPI payment</small>
                        </div>
                    </div>

                    <div class="security-info">
                        <i class="fas fa-lock"></i> <strong>Your payment is 100% secure</strong>
                    </div>
                </div>
            </div>

            <!-- Order Summary Sidebar -->
            <div class="col-lg-4">
                <div class="order-summary">
                    <h5 class="mb-3">Order Summary</h5>

                    <div class="summary-row">
                        <span>Subtotal:</span>
                        <span>₹<?php echo e(number_format($total, 2)); ?></span>
                    </div>

                    <?php if($total >= 500): ?>
                        <div class="summary-row">
                            <span>Shipping:</span>
                            <span class="text-success">FREE</span>
                        </div>
                    <?php else: ?>
                        <div class="summary-row">
                            <span>Shipping:</span>
                            <span>₹100</span>
                        </div>
                    <?php endif; ?>

                    <div class="summary-row">
                        <span>Tax (18%):</span>
                        <span>₹<?php echo e(number_format($total * 0.18, 2)); ?></span>
                    </div>

                    <div class="summary-row total">
                        <span>Total:</span>
                        <span>₹<?php echo e(number_format($total + ($total * 0.18) + ($total >= 500 ? 0 : 100), 2)); ?></span>
                    </div>

                    <button type="submit" class="btn btn-light btn-lg w-100 fw-bold mt-4">
                        <i class="fas fa-check-circle"></i> Place Order
                    </button>

                    <a href="<?php echo e(route('cart.index')); ?>" class="btn btn-outline-light w-100 mt-2">
                        <i class="fas fa-arrow-left"></i> Back to Cart
                    </a>

                    <!-- Order Details -->
                    <div class="mt-4 pt-3" style="border-top: 1px solid rgba(255, 255, 255, 0.2);">
                        <h6 class="mb-2">Order Details</h6>
                        <small>
                            <i class="fas fa-info-circle"></i> Items: <?php echo e($cartItems->sum('quantity')); ?><br>
                            <i class="fas fa-box"></i> Packages: 1<br>
                            <i class="fas fa-calendar"></i> Est. Delivery: 3-5 days
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Laravel-Projects\e-commerce-system\fruit-shop\resources\views/checkout/index.blade.php ENDPATH**/ ?>