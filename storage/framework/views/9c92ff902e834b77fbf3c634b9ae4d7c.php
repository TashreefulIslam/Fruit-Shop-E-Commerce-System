

<?php $__env->startSection('title', $category->name . ' Products - Fruit Shop'); ?>

<?php $__env->startSection('content'); ?>
    <div class="mb-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Home</a></li>
                <li class="breadcrumb-item active"><?php echo e($category->name); ?></li>
            </ol>
        </nav>

        <h1 class="mb-3"><?php echo e($category->name); ?> Products</h1>
        <p class="text-muted"><?php echo e($products->total()); ?> products found</p>
    </div>

    <div class="row">
        <!-- Sidebar -->
        <div class="col-lg-3 mb-4">
            <div class="bg-white p-4 rounded" style="box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);">
                <h5 class="mb-3">
                    <i class="fas fa-list"></i> Categories
                </h5>
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('categories.show', $cat->id)); ?>" 
                       class="d-block py-2 <?php echo e($cat->id == $category->id ? 'text-primary fw-bold' : 'text-decoration-none text-dark'); ?>"
                       style="transition: all 0.3s ease;">
                        <?php echo e($cat->name); ?>

                        <span class="badge bg-light text-dark float-end"><?php echo e($cat->products->count()); ?></span>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>

        <!-- Products -->
        <div class="col-lg-9">
            <?php if($products->count() > 0): ?>
                <div class="row g-4 mb-4">
                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-6 col-lg-4">
                            <div class="card product-card h-100">
                                <div class="product-image">
                                    <?php if($product->image_url): ?>
                                        <img src="<?php echo e($product->image_url); ?>" alt="<?php echo e($product->name); ?>" loading="lazy">
                                    <?php else: ?>
                                        <div class="d-flex align-items-center justify-content-center h-100 bg-light">
                                            <i class="fas fa-image text-muted fa-3x"></i>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="product-info">
                                    <h5 class="product-name"><?php echo e($product->name); ?></h5>
                                    <div class="product-price">₹<?php echo e(number_format($product->price, 2)); ?></div>
                                    <div class="product-stock">
                                        <?php if($product->isInStock()): ?>
                                            <span class="badge bg-success">In Stock</span>
                                        <?php else: ?>
                                            <span class="badge bg-danger">Out of Stock</span>
                                        <?php endif; ?>
                                    </div>
                                    <a href="<?php echo e(route('products.show', $product->id)); ?>" class="btn btn-primary btn-sm w-100">
                                        <i class="fas fa-eye"></i> View Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center">
                    <?php echo e($products->links()); ?>

                </div>
            <?php else: ?>
                <div class="empty-state">
                    <i class="fas fa-inbox"></i>
                    <p>No products in this category</p>
                    <a href="<?php echo e(route('products.index')); ?>" class="btn btn-primary">View All Products</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Laravel-Projects\e-commerce-system\fruit-shop\resources\views/products/category.blade.php ENDPATH**/ ?>