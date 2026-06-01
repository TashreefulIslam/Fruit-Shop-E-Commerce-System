

<?php $__env->startSection('title', 'Manage Products - Admin'); ?>

<?php $__env->startSection('content'); ?>
    <div class="page-header">
        <h1><i class="fas fa-box"></i> Products</h1>
        <a href="<?php echo e(route('admin.products.create')); ?>" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add Product
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <?php if($products->count() > 0): ?>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Stock</th>
                                <th>Created</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><strong>#<?php echo e($product->id); ?></strong></td>
                                    <td>
                                        <?php if($product->image_url): ?>
                                            <img src="<?php echo e($product->image_url); ?>" alt="<?php echo e($product->name); ?>" style="width: 40px; height: 40px; object-fit: cover; border-radius: 4px;">
                                        <?php else: ?>
                                            <span class="text-muted">No image</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo e(Str::limit($product->name, 30)); ?></td>
                                    <td><span class="badge bg-info"><?php echo e($product->category->name); ?></span></td>
                                    <td>₹<?php echo e(number_format($product->price, 2)); ?></td>
                                    <td>
                                        <?php if($product->stock < 5): ?>
                                            <span class="badge bg-danger"><?php echo e($product->stock); ?></span>
                                        <?php elseif($product->stock < 20): ?>
                                            <span class="badge bg-warning"><?php echo e($product->stock); ?></span>
                                        <?php else: ?>
                                            <span class="badge bg-success"><?php echo e($product->stock); ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo e($product->created_at->format('d M Y')); ?></td>
                                    <td>
                                        <a href="<?php echo e(route('admin.products.edit', $product->id)); ?>" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="<?php echo e(route('admin.products.destroy', $product->id)); ?>" method="POST" style="display:inline;">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
                <?php echo e($products->links()); ?>

            <?php else: ?>
                <div class="text-center py-5">
                    <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                    <p class="text-muted">No products found</p>
                    <a href="<?php echo e(route('admin.products.create')); ?>" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Create First Product
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Laravel-Projects\e-commerce-system\fruit-shop\resources\views/admin/products/index.blade.php ENDPATH**/ ?>