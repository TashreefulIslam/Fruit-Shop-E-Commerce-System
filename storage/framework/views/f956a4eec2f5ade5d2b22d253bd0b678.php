

<?php $__env->startSection('title', 'Shopping Cart - Fruit Shop'); ?>

<?php $__env->startSection('extra-css'); ?>
<style>
    .cart-container {
        background: white;
        border-radius: 12px;
        padding: 2rem;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        margin-bottom: 2rem;
    }

    .cart-item {
        display: flex;
        gap: 2rem;
        padding: 1.5rem;
        border-bottom: 1px solid var(--light-color);
        align-items: center;
    }

    .cart-item:last-child {
        border-bottom: none;
    }

    .item-image {
        width: 120px;
        height: 120px;
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
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--dark-color);
        margin-bottom: 0.5rem;
    }

    .item-category {
        color: #999;
        font-size: 0.9rem;
        margin-bottom: 1rem;
    }

    .item-price {
        font-size: 1.3rem;
        color: var(--primary-color);
        font-weight: 700;
    }

    .item-actions {
        display: flex;
        gap: 1rem;
        align-items: center;
    }

    .quantity-input {
        display: flex;
        align-items: center;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
    }

    .quantity-input button {
        background: none;
        border: none;
        width: 35px;
        height: 35px;
        cursor: pointer;
        color: var(--primary-color);
    }

    .quantity-input input {
        border: none;
        width: 50px;
        text-align: center;
        outline: none;
    }

    .item-total {
        font-size: 1.2rem;
        font-weight: 700;
        color: var(--dark-color);
        min-width: 100px;
        text-align: right;
    }

    .remove-btn {
        background: #f8d7da;
        color: #721c24;
        border: none;
        padding: 0.5rem 1rem;
        border-radius: 6px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .remove-btn:hover {
        background: #f5c6cb;
    }

    .cart-summary {
        background: linear-gradient(135deg, var(--secondary-color) 0%, var(--primary-color) 100%);
        color: white;
        border-radius: 12px;
        padding: 2rem;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
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

    .empty-cart {
        text-align: center;
        padding: 4rem 2rem;
    }

    .empty-cart i {
        font-size: 4rem;
        color: #ccc;
        margin-bottom: 1rem;
    }

    .empty-cart p {
        color: #999;
        font-size: 1.1rem;
        margin-bottom: 2rem;
    }

    @media (max-width: 768px) {
        .cart-item {
            flex-wrap: wrap;
            gap: 1rem;
        }

        .item-image {
            width: 100px;
            height: 100px;
        }

        .item-actions {
            flex-wrap: wrap;
            width: 100%;
        }

        .item-total {
            width: 100%;
            text-align: left;
        }
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="mb-4">
        <h1 class="mb-2">
            <i class="fas fa-shopping-cart"></i> Shopping Cart
        </h1>
        <p class="text-muted">Review your items before checkout</p>
    </div>

    <div class="row">
        <!-- Cart Items -->
        <div class="col-lg-8">
            <?php if($cartItems->count() > 0): ?>
                <div class="cart-container">
                    <?php $__currentLoopData = $cartItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="cart-item">
                            <!-- Product Image -->
                            <div class="item-image">
                                <?php if($item->product->image): ?>
                                    <img src="<?php echo e($item->product->image_url); ?>" alt="<?php echo e($item->product->name); ?>">
                                <?php else: ?>
                                    <div class="d-flex align-items-center justify-content-center h-100">
                                        <i class="fas fa-image text-muted"></i>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <!-- Product Details -->
                            <div class="item-details">
                                <a href="<?php echo e(route('products.show', $item->product->id)); ?>" class="item-name text-decoration-none text-dark">
                                    <?php echo e($item->product->name); ?>

                                </a>
                                <div class="item-category"><?php echo e($item->product->category->name); ?></div>
                                <div class="item-price">₹<?php echo e(number_format($item->product->price, 2)); ?></div>
                            </div>

                            <!-- Actions -->
                            <div class="item-actions">
                                <!-- Quantity -->
                                <div>
                                    <form action="<?php echo e(route('cart.update', $item->id)); ?>" method="POST" class="quantity-input">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('PUT'); ?>
                                        <button type="button" onclick="this.parentElement.querySelector('input').value = Math.max(1, parseInt(this.parentElement.querySelector('input').value) - 1); this.parentElement.submit();">-</button>
                                        <input type="number" name="quantity" value="<?php echo e($item->quantity); ?>" min="1" max="<?php echo e($item->product->stock); ?>" onchange="this.parentElement.submit();">
                                        <button type="button" onclick="this.parentElement.querySelector('input').value = Math.min(<?php echo e($item->product->stock); ?>, parseInt(this.parentElement.querySelector('input').value) + 1); this.parentElement.submit();">+</button>
                                    </form>
                                </div>

                                <!-- Total Price -->
                                <div class="item-total">
                                    ₹<?php echo e(number_format($item->product->price * $item->quantity, 2)); ?>

                                </div>

                                <!-- Remove Button -->
                                <form action="<?php echo e(route('cart.remove', $item->id)); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="remove-btn">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <!-- Continue Shopping -->
                <div class="mb-4">
                    <a href="<?php echo e(route('products.index')); ?>" class="btn btn-outline-primary">
                        <i class="fas fa-arrow-left"></i> Continue Shopping
                    </a>
                </div>
            <?php else: ?>
                <div class="cart-container">
                    <div class="empty-cart">
                        <i class="fas fa-shopping-cart"></i>
                        <p>Your cart is empty</p>
                        <a href="<?php echo e(route('products.index')); ?>" class="btn btn-primary">
                            <i class="fas fa-shopping-bag"></i> Start Shopping
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Cart Summary -->
        <?php if($cartItems->count() > 0): ?>
            <div class="col-lg-4">
                <div class="cart-summary position-sticky" style="top: 100px;">
                    <h5 class="mb-3">Order Summary</h5>

                    <div class="summary-row">
                        <span>Subtotal:</span>
                        <span>₹<?php echo e(number_format($total, 2)); ?></span>
                    </div>

                    <div class="summary-row">
                        <span>Shipping:</span>
                        <span><?php echo e($total >= 500 ? 'FREE' : '₹100'); ?></span>
                    </div>

                    <div class="summary-row">
                        <span>Tax (18%):</span>
                        <span>₹<?php echo e(number_format($total * 0.18, 2)); ?></span>
                    </div>

                    <div class="summary-row total">
                        <span>Total:</span>
                        <span>₹<?php echo e(number_format($total + ($total * 0.18) + ($total >= 500 ? 0 : 100), 2)); ?></span>
                    </div>

                    <a href="<?php echo e(route('checkout.index')); ?>" class="btn btn-light btn-lg w-100 fw-bold mt-4">
                        <i class="fas fa-credit-card"></i> Proceed to Checkout
                    </a>

                    <form action="<?php echo e(route('cart.clear')); ?>" method="POST" class="mt-3">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn btn-outline-light w-100" onclick="return confirm('Are you sure you want to clear your cart?')">
                            <i class="fas fa-trash"></i> Clear Cart
                        </button>
                    </form>

                    <!-- Security Info -->
                    <div class="mt-4 pt-3" style="border-top: 1px solid rgba(255, 255, 255, 0.2);">
                        <small>
                            <i class="fas fa-lock"></i> Your payment is secure and encrypted
                        </small>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Laravel-Projects\e-commerce-system\fruit-shop\resources\views/cart/index.blade.php ENDPATH**/ ?>