

<?php $__env->startSection('title', 'My Profile - Fruit Shop'); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <?php if(session('success')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    <?php echo e(session('success')); ?>

                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <div class="card shadow-lg border-0">
                <div class="card-header" style="background: linear-gradient(135deg, var(--primary-color), #ff8555); color: white; padding: 2rem;">
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <i class="fas fa-user-circle" style="font-size: 3rem;"></i>
                        </div>
                        <div>
                            <h3 class="mb-0"><?php echo e($user->name); ?></h3>
                            <p class="mb-0 small">
                                <?php if($user->isAdmin()): ?>
                                    <span class="badge bg-warning">Admin</span>
                                <?php else: ?>
                                    <span class="badge bg-info">Customer</span>
                                <?php endif; ?>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h6 class="text-muted text-uppercase fw-bold mb-2">Email Address</h6>
                            <p class="lead"><?php echo e($user->email); ?></p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-muted text-uppercase fw-bold mb-2">Account Type</h6>
                            <p class="lead">
                                <?php if($user->isAdmin()): ?>
                                    <span class="badge bg-warning fs-6">Administrator</span>
                                <?php else: ?>
                                    <span class="badge bg-info fs-6">Regular Customer</span>
                                <?php endif; ?>
                            </p>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h6 class="text-muted text-uppercase fw-bold mb-2">Member Since</h6>
                            <p class="lead"><?php echo e($user->created_at->format('F d, Y')); ?></p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-muted text-uppercase fw-bold mb-2">Last Updated</h6>
                            <p class="lead"><?php echo e($user->updated_at->format('F d, Y H:i')); ?></p>
                        </div>
                    </div>

                    <hr>

                    <div class="mt-4">
                        <h5 class="fw-bold mb-3">Quick Stats</h5>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="text-center p-3 bg-light rounded">
                                    <h3 class="fw-bold" style="color: var(--primary-color);"><?php echo e($user->orders->count()); ?></h3>
                                    <p class="text-muted small">Total Orders</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="text-center p-3 bg-light rounded">
                                    <h3 class="fw-bold" style="color: var(--primary-color);">₹<?php echo e($user->orders->sum('total_price')); ?></h3>
                                    <p class="text-muted small">Total Spent</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="text-center p-3 bg-light rounded">
                                    <h3 class="fw-bold" style="color: var(--primary-color);">
                                        <?php echo e($user->orders->where('status', 'Delivered')->count()); ?>

                                    </h3>
                                    <p class="text-muted small">Delivered Orders</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer bg-light p-4">
                    <a href="<?php echo e(route('profile.edit')); ?>" class="btn btn-primary btn-lg me-2">
                        <i class="fas fa-edit me-2"></i>Edit Profile
                    </a>
                    <?php if($user->isAdmin()): ?>
                        <a href="<?php echo e(route('admin.dashboard')); ?>" class="btn btn-success btn-lg me-2">
                            <i class="fas fa-tachometer-alt me-2"></i>Admin Dashboard
                        </a>
                    <?php endif; ?>
                    <a href="<?php echo e(route('orders.index')); ?>" class="btn btn-info btn-lg">
                        <i class="fas fa-history me-2"></i>View Orders
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Laravel-Projects\e-commerce-system\fruit-shop\resources\views/profile/show.blade.php ENDPATH**/ ?>