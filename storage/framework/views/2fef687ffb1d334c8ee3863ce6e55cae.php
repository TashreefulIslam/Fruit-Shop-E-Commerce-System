

<?php $__env->startSection('title', 'Manage Orders - Admin'); ?>

<?php $__env->startSection('content'); ?>
    <div class="page-header">
        <h1><i class="fas fa-shopping-cart"></i> Orders</h1>
    </div>

    <div class="card">
        <div class="card-body">
            <?php if($orders->count() > 0): ?>
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
                            <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><strong>#<?php echo e($order->id); ?></strong></td>
                                    <td><?php echo e($order->user->name); ?></td>
                                    <td>₹<?php echo e(number_format($order->total_price, 2)); ?></td>
                                    <td>
                                        <span class="badge 
                                            <?php if($order->status === 'Pending'): ?> bg-warning
                                            <?php elseif($order->status === 'Processing'): ?> bg-info
                                            <?php else: ?> bg-success
                                            <?php endif; ?>">
                                            <?php echo e($order->status); ?>

                                        </span>
                                    </td>
                                    <td><span class="badge bg-light text-dark"><?php echo e($order->items->sum('quantity')); ?></span></td>
                                    <td><?php echo e($order->created_at->format('d M Y')); ?></td>
                                    <td>
                                        <a href="<?php echo e(route('admin.orders.show', $order->id)); ?>" class="btn btn-sm btn-primary">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
                <?php echo e($orders->links()); ?>

            <?php else: ?>
                <div class="text-center py-5">
                    <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                    <p class="text-muted">No orders found</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Laravel-Projects\e-commerce-system\fruit-shop\resources\views/admin/orders/index.blade.php ENDPATH**/ ?>