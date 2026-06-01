

<?php $__env->startSection('title', 'Products - Fruit Shop'); ?>

<?php $__env->startSection('extra-css'); ?>
<style>
    .filter-sidebar {
        background: white;
        border-radius: 12px;
        padding: 2rem;
        height: fit-content;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
    }

    .filter-title {
        font-weight: 700;
        font-size: 1.1rem;
        margin-bottom: 1.5rem;
        color: var(--dark-color);
        border-bottom: 2px solid var(--light-color);
        padding-bottom: 1rem;
    }

    .filter-group {
        margin-bottom: 2rem;
    }

    .filter-group label {
        display: flex;
        align-items: center;
        cursor: pointer;
        margin-bottom: 0.5rem;
        color: #555;
        transition: all 0.3s ease;
    }

    .filter-group label:hover {
        color: var(--primary-color);
    }

    .filter-group input[type="checkbox"] {
        margin-right: 0.5rem;
        cursor: pointer;
        accent-color: var(--primary-color);
    }

    .product-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 2rem;
    }

    .page-title {
        margin-bottom: 3rem;
        padding-bottom: 2rem;
        border-bottom: 2px solid var(--light-color);
    }

    .page-title h1 {
        font-size: 2.5rem;
        font-weight: 700;
        color: var(--dark-color);
        margin-bottom: 0.5rem;
    }

    .view-options {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        padding: 1.5rem;
        background: white;
        border-radius: 12px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
    }

    .sort-dropdown {
        min-width: 200px;
    }

    @media (max-width: 768px) {
        .product-grid {
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 1rem;
        }

        .filter-sidebar {
            margin-bottom: 2rem;
        }

        .view-options {
            flex-direction: column;
            gap: 1rem;
        }

        .sort-dropdown {
            width: 100%;
        }
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="page-title">
        <h1><i class="fas fa-boxes"></i> All Products</h1>
        <p class="text-muted">Showing <?php echo e($products->count()); ?> products</p>
    </div>

    <div class="row">
        <!-- Sidebar Filter -->
        <div class="col-lg-3 mb-4">
            <div class="filter-sidebar">
                <h5 class="filter-title"><i class="fas fa-filter"></i> Filters</h5>

                <!-- Category Filter -->
                <div class="filter-group">
                    <h6 class="fw-600 mb-2">Categories</h6>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <label>
                            <input type="checkbox">
                            <?php echo e($category->name); ?>

                        </label>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <!-- Price Filter -->
                <div class="filter-group">
                    <h6 class="fw-600 mb-2">Price Range</h6>
                    <label>
                        <input type="checkbox"> Under ₹500
                    </label>
                    <label>
                        <input type="checkbox"> ₹500 - ₹1000
                    </label>
                    <label>
                        <input type="checkbox"> ₹1000 - ₹5000
                    </label>
                    <label>
                        <input type="checkbox"> Above ₹5000
                    </label>
                </div>

                <!-- Availability Filter -->
                <div class="filter-group">
                    <h6 class="fw-600 mb-2">Availability</h6>
                    <label>
                        <input type="checkbox"> In Stock
                    </label>
                    <label>
                        <input type="checkbox"> Out of Stock
                    </label>
                </div>

                <a href="<?php echo e(route('products.index')); ?>" class="btn btn-outline-primary w-100">
                    <i class="fas fa-redo"></i> Reset Filters
                </a>
            </div>
        </div>

        <!-- Products -->
        <div class="col-lg-9">
            <!-- View Options -->
            <div class="view-options">
                <div class="results-count">
                    Showing <strong><?php echo e($products->count()); ?></strong> results
                </div>
                <div class="sort-dropdown">
                    <select class="form-select" onchange="location = this.value;">
                        <option value="<?php echo e(route('products.index')); ?>">Sort by: Featured</option>
                        <option value="<?php echo e(route('products.index')); ?>?sort=newest">Newest</option>
                        <option value="<?php echo e(route('products.index')); ?>?sort=price_low">Price: Low to High</option>
                        <option value="<?php echo e(route('products.index')); ?>?sort=price_high">Price: High to Low</option>
                    </select>
                </div>
            </div>

            <?php if($products->count() > 0): ?>
                <div class="product-grid">
                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="card product-card">
                            <div class="product-image">
                                <?php if($product->image_url): ?>
                                    <img src="<?php echo e($product->image_url); ?>" alt="<?php echo e($product->name); ?>" loading="lazy">
                                <?php else: ?>
                                    <div class="d-flex align-items-center justify-content-center h-100 bg-light">
                                        <i class="fas fa-image text-muted fa-3x"></i>
                                    </div>
                                <?php endif; ?>
                                <?php if($product->stock < 5 && $product->stock > 0): ?>
                                    <span class="product-badge bg-warning">
                                        Only <?php echo e($product->stock); ?> left
                                    </span>
                                <?php elseif($product->stock == 0): ?>
                                    <span class="product-badge bg-danger">Out of Stock</span>
                                <?php endif; ?>
                            </div>
                            <div class="product-info">
                                <h5 class="product-name"><?php echo e($product->name); ?></h5>
                                <small class="text-muted"><?php echo e($product->category->name); ?></small>
                                <div class="product-price">₹<?php echo e(number_format($product->price, 2)); ?></div>
                                <div class="product-stock mb-2">
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
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-5">
                    <?php echo e($products->links()); ?>

                </div>
            <?php else: ?>
                <div class="empty-state">
                    <i class="fas fa-inbox"></i>
                    <p>No products found</p>
                    <a href="<?php echo e(route('home')); ?>" class="btn btn-primary">Back to Home</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Laravel-Projects\e-commerce-system\fruit-shop\resources\views/products/index.blade.php ENDPATH**/ ?>