

<?php $__env->startSection('title', 'Order Details - Admin'); ?>

<?php $__env->startSection('content'); ?>
    <div class="page-header">
        <h1><i class="fas fa-receipt"></i> Order #<?php echo e($order->id); ?></h1>
        <a href="<?php echo e(route('admin.orders.index')); ?>" class="btn btn-outline-secondary">
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
                                <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($item->product->name); ?></td>
                                        <td><?php echo e($item->quantity); ?></td>
                                        <td>₹<?php echo e(number_format($item->price, 2)); ?></td>
                                        <td><strong>₹<?php echo e(number_format($item->price * $item->quantity, 2)); ?></strong></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                    <form action="<?php echo e(route('admin.orders.updateStatus', $order->id)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>
                        
                        <div class="mb-3">
                            <label for="status" class="form-label">Order Status</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="Pending" <?php echo e($order->status === 'Pending' ? 'selected' : ''); ?>>Pending</option>
                                <option value="Processing" <?php echo e($order->status === 'Processing' ? 'selected' : ''); ?>>Processing</option>
                                <option value="Delivered" <?php echo e($order->status === 'Delivered' ? 'selected' : ''); ?>>Delivered</option>
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
                        <p><?php echo e($order->user->name); ?></p>
                    </div>
                    <div class="mb-3">
                        <strong>Email</strong>
                        <p><?php echo e($order->user->email); ?></p>
                    </div>
                    <div class="mb-3">
                        <strong>Phone</strong>
                        <p><?php echo e($order->phone); ?></p>
                    </div>
                </div>
            </div>

            <!-- Delivery Info -->
            <div class="card mb-4">
                <div class="card-header bg-white border-bottom">
                    <h5 class="mb-0"><i class="fas fa-map-marker-alt"></i> Delivery Address</h5>
                </div>
                <div class="card-body">
                    <?php echo e($order->address); ?>

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
                        <strong>₹<?php echo e(number_format($order->total_price, 2)); ?></strong>
                    </div>
                    <div class="mb-2 d-flex justify-content-between">
                        <span>Tax (18%):</span>
                        <strong>₹<?php echo e(number_format($order->total_price * 0.18, 2)); ?></strong>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between" style="font-size: 1.2rem; font-weight: 700;">
                        <span>Total:</span>
                        <strong>₹<?php echo e(number_format($order->total_price + ($order->total_price * 0.18), 2)); ?></strong>
                    </div>

                    <div class="mt-3">
                        <span class="badge 
                            <?php if($order->status === 'Pending'): ?> bg-warning
                            <?php elseif($order->status === 'Processing'): ?> bg-info
                            <?php else: ?> bg-success
                            <?php endif; ?>" 
                            style="font-size: 1rem;">
                            <?php echo e($order->status); ?>

                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Laravel-Projects\e-commerce-system\fruit-shop\resources\views/admin/orders/show.blade.php ENDPATH**/ ?>