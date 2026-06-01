

<?php $__env->startSection('title', 'Manage Categories - Admin'); ?>

<?php $__env->startSection('content'); ?>
    <div class="page-header">
        <h1><i class="fas fa-list"></i> Categories</h1>
        <a href="<?php echo e(route('admin.categories.create')); ?>" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add Category
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <?php if($categories->count() > 0): ?>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Products</th>
                                <th>Created</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><strong>#<?php echo e($category->id); ?></strong></td>
                                    <td><?php echo e($category->name); ?></td>
                                    <td><?php echo e(Str::limit($category->description ?? 'N/A', 50)); ?></td>
                                    <td><span class="badge bg-info"><?php echo e($category->products_count); ?></span></td>
                                    <td><?php echo e($category->created_at->format('d M Y')); ?></td>
                                    <td>
                                        <a href="<?php echo e(route('admin.categories.edit', $category->id)); ?>" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="<?php echo e(route('admin.categories.destroy', $category->id)); ?>" method="POST" style="display:inline;">
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
                <?php echo e($categories->links()); ?>

            <?php else: ?>
                <div class="text-center py-5">
                    <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                    <p class="text-muted">No categories found</p>
                    <a href="<?php echo e(route('admin.categories.create')); ?>" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Create First Category
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Laravel-Projects\e-commerce-system\fruit-shop\resources\views/admin/categories/index.blade.php ENDPATH**/ ?>