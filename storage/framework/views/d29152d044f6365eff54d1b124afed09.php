

<?php $__env->startSection('title', 'Home - Fruit Shop'); ?>

<?php $__env->startSection('extra-css'); ?>
<style>
    .hero-section {
        background: linear-gradient(135deg, #004E89 0%, #FF6B35 100%);
        color: white;
        padding: 6rem 2rem;
        border-radius: 15px;
        margin-bottom: 4rem;
        text-align: center;
    }

    .hero-section h1 {
        font-size: 3.5rem;
        font-weight: 700;
        margin-bottom: 1rem;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
    }

    .hero-section p {
        font-size: 1.3rem;
        margin-bottom: 2rem;
        opacity: 0.95;
    }

    .hero-buttons {
        display: flex;
        gap: 1rem;
        justify-content: center;
        flex-wrap: wrap;
    }

    .section-title {
        text-align: center;
        margin-bottom: 3rem;
        position: relative;
        padding-bottom: 1rem;
    }

    .section-title h2 {
        font-size: 2.5rem;
        font-weight: 700;
        color: var(--dark-color);
        margin-bottom: 0.5rem;
    }

    .section-title::after {
        content: '';
        position: absolute;
        width: 80px;
        height: 4px;
        background: linear-gradient(135deg, var(--secondary-color) 0%, var(--primary-color) 100%);
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        border-radius: 2px;
    }

    .section-title p {
        color: #666;
        font-size: 1.1rem;
    }

    .category-card {
        text-align: center;
        padding: 2rem;
        border-radius: 12px;
        background: white;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .category-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
    }

    .category-icon {
        font-size: 3.5rem;
        color: var(--primary-color);
        margin-bottom: 1rem;
    }

    .category-card h5 {
        font-weight: 700;
        color: var(--dark-color);
        margin-bottom: 0.5rem;
    }

    .category-card .count {
        color: #999;
        font-size: 0.9rem;
    }

    .product-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 2rem;
        margin-bottom: 3rem;
    }

    .featured-badge {
        position: absolute;
        top: 10px;
        left: 10px;
        background: linear-gradient(135deg, #FF6B35 0%, #FF8C5A 100%);
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 50px;
        font-size: 0.8rem;
        font-weight: 700;
    }

    @media (max-width: 768px) {
        .hero-section h1 {
            font-size: 2rem;
        }

        .section-title h2 {
            font-size: 1.8rem;
        }

        .product-grid {
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 1rem;
        }
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!-- Hero Section -->
    <div class="hero-section mb-5">
        <h1><i class="fas fa-leaf"></i> Fresh Fruits Delivered</h1>
        <p>Premium quality fruits directly to your doorstep. Fresh, organic, and always delicious!</p>
        <div class="hero-buttons">
            <a href="<?php echo e(route('products.index')); ?>" class="btn btn-light btn-lg">
                <i class="fas fa-shopping-bag"></i> Shop Now
            </a>
            <a href="<?php echo e(route('products.search')); ?>?q=" class="btn btn-outline-light btn-lg">
                <i class="fas fa-search"></i> Browse All
            </a>
        </div>
    </div>

    <!-- Featured Products Section -->
    <div class="mb-5">
        <div class="section-title">
            <h2>Featured Products</h2>
            <p>Check out our best sellers this week</p>
        </div>

        <?php if($featuredProducts->count() > 0): ?>
            <div class="product-grid">
                <?php $__currentLoopData = $featuredProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="card product-card">
                        <div class="product-image">
                            <?php if($product->image_url): ?>
                                <img src="<?php echo e($product->image_url); ?>" alt="<?php echo e($product->name); ?>" loading="lazy">
                            <?php else: ?>
                                <div class="d-flex align-items-center justify-content-center h-100 bg-light">
                                    <i class="fas fa-image text-muted fa-3x"></i>
                                </div>
                            <?php endif; ?>
                            <span class="featured-badge">
                                <i class="fas fa-star"></i> Featured
                            </span>
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
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Categories Section -->
    <div class="mb-5">
        <div class="section-title">
            <h2>Shop by Category</h2>
            <p>Explore our wide range of products</p>
        </div>

        <?php if($categories->count() > 0): ?>
            <div class="row g-4">
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-4 col-lg-2">
                        <a href="<?php echo e(route('categories.show', $category->id)); ?>" class="text-decoration-none">
                            <div class="category-card">
                                <div class="category-icon">
                                    <i class="fas fa-apple-alt"></i>
                                </div>
                                <h5><?php echo e($category->name); ?></h5>
                                <span class="count"><?php echo e($category->products->count()); ?> items</span>
                            </div>
                        </a>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Latest Products Section -->
    <div class="mb-5">
        <div class="section-title">
            <h2>Latest Arrivals</h2>
            <p>Discover our newest additions</p>
        </div>

        <?php if($latestProducts->count() > 0): ?>
            <div class="product-grid">
                <?php $__currentLoopData = $latestProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                                <span class="product-badge">
                                    Only <?php echo e($product->stock); ?> left
                                </span>
                            <?php elseif($product->stock == 0): ?>
                                <span class="product-badge bg-danger">Out of Stock</span>
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
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <div class="text-center mt-4">
                <a href="<?php echo e(route('products.index')); ?>" class="btn btn-primary btn-lg">
                    <i class="fas fa-store"></i> View All Products
                </a>
            </div>
        <?php endif; ?>
    </div>

    <!-- CTA Section -->
    <div class="bg-light p-5 rounded-4 text-center mb-5">
        <h3 class="mb-3">Ready to Shop?</h3>
        <p class="text-muted mb-4">Browse our collection and get fresh fruits delivered to your door</p>
        <?php if(auth()->guard()->check()): ?>
            <a href="<?php echo e(route('products.index')); ?>" class="btn btn-primary btn-lg">
                <i class="fas fa-shopping-cart"></i> Start Shopping
            </a>
        <?php else: ?>
            <a href="<?php echo e(route('login')); ?>" class="btn btn-primary btn-lg me-2">
                <i class="fas fa-sign-in-alt"></i> Login
            </a>
            <a href="<?php echo e(route('register')); ?>" class="btn btn-outline-primary btn-lg">
                <i class="fas fa-user-plus"></i> Sign Up
            </a>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Laravel-Projects\e-commerce-system\fruit-shop\resources\views/home.blade.php ENDPATH**/ ?>