<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'Admin Dashboard - Fruit Shop'); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #FF6B35;
            --secondary-color: #004E89;
            --light-color: #F8F9FA;
            --dark-color: #1A1A1A;
            --sidebar-width: 250px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
            display: flex;
        }

        /* Sidebar */
        .sidebar {
            width: var(--sidebar-width);
            background: linear-gradient(135deg, var(--secondary-color) 0%, var(--primary-color) 100%);
            color: white;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            padding: 2rem 0;
            z-index: 1000;
        }

        .sidebar-brand {
            padding: 0 1.5rem;
            margin-bottom: 2rem;
            font-size: 1.5rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .sidebar-menu {
            list-style: none;
        }

        .sidebar-menu li {
            margin-bottom: 0.5rem;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem 1.5rem;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border-left: 4px solid white;
            padding-left: calc(1.5rem - 4px);
        }

        /* Main Content */
        .main-content {
            margin-left: var(--sidebar-width);
            flex: 1;
        }

        .topbar {
            background: white;
            padding: 1rem 2rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .topbar-user {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .topbar-user img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }

        .content {
            padding: 2rem;
        }

        /* Cards */
        .card {
            border: none;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            border-radius: 12px;
            margin-bottom: 2rem;
        }

        /* Stat Box */
        .stat-box {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            text-align: center;
            border-left: 4px solid var(--primary-color);
        }

        .stat-icon {
            font-size: 3rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        .stat-value {
            font-size: 2rem;
            font-weight: 700;
            color: var(--dark-color);
            margin-bottom: 0.5rem;
        }

        .stat-label {
            color: #999;
            font-size: 0.9rem;
        }

        /* Tables */
        .table {
            background: white;
        }

        .table thead {
            background-color: var(--light-color);
            border-bottom: 2px solid var(--primary-color);
        }

        .table thead th {
            color: var(--dark-color);
            font-weight: 600;
        }

        .table tbody tr:hover {
            background-color: var(--light-color);
        }

        /* Buttons */
        .btn-primary {
            background: linear-gradient(135deg, var(--secondary-color) 0%, var(--primary-color) 100%);
            border: none;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(255, 107, 53, 0.3);
            color: white;
        }

        /* Forms */
        .form-control, .form-select {
            border: 1px solid #e0e0e0;
            border-radius: 8px;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(255, 107, 53, 0.25);
        }

        /* Page Title */
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .page-header h1 {
            font-size: 2rem;
            font-weight: 700;
            color: var(--dark-color);
        }

        .alert {
            border-radius: 10px;
            border: none;
            margin-bottom: 2rem;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 60px;
            }

            .sidebar-brand,
            .sidebar-menu a span {
                display: none;
            }

            .sidebar-menu a {
                justify-content: center;
                padding: 1rem;
            }

            .main-content {
                margin-left: 60px;
            }

            .topbar {
                flex-direction: column;
                gap: 1rem;
            }

            .page-header {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>
    <?php echo $__env->yieldContent('extra-css'); ?>
</head>
<body>
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="sidebar-brand">
            <i class="fas fa-leaf"></i>
            <span>Fruit Shop</span>
        </div>

        <ul class="sidebar-menu">
            <li>
                <a href="<?php echo e(route('admin.dashboard')); ?>" <?php if(request()->route()->getName() === 'admin.dashboard'): ?> class="active" <?php endif; ?>>
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="<?php echo e(route('admin.categories.index')); ?>" <?php if(request()->route()->getName() === 'admin.categories.index'): ?> class="active" <?php endif; ?>>
                    <i class="fas fa-list"></i>
                    <span>Categories</span>
                </a>
            </li>
            <li>
                <a href="<?php echo e(route('admin.products.index')); ?>" <?php if(request()->route()->getName() === 'admin.products.index'): ?> class="active" <?php endif; ?>>
                    <i class="fas fa-box"></i>
                    <span>Products</span>
                </a>
            </li>
            <li>
                <a href="<?php echo e(route('admin.orders.index')); ?>" <?php if(request()->route()->getName() === 'admin.orders.index'): ?> class="active" <?php endif; ?>>
                    <i class="fas fa-shopping-cart"></i>
                    <span>Orders</span>
                </a>
            </li>
            <li>
                <hr style="border: none; border-top: 1px solid rgba(255,255,255,0.2); margin: 1rem 0;">
            </li>
            <li>
                <a href="<?php echo e(route('home')); ?>">
                    <i class="fas fa-globe"></i>
                    <span>Website</span>
                </a>
            </li>
            <li>
                <form action="<?php echo e(route('logout')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="btn btn-link" style="color: inherit; padding: 1rem 1.5rem; width: 100%; text-align: left; border: none; background: none;">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </li>
        </ul>
    </aside>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Topbar -->
        <div class="topbar">
            <div></div>
            <div class="topbar-user">
                <span><?php echo e(auth()->user()->name); ?></span>
                <img src="https://ui-avatars.com/api/?name=<?php echo e(auth()->user()->name); ?>" alt="<?php echo e(auth()->user()->name); ?>">
            </div>
        </div>

        <!-- Content -->
        <div class="content">
            <?php if($errors->any()): ?>
                <div class="alert alert-danger">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div><?php echo e($error); ?></div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php endif; ?>

            <?php if(session('success')): ?>
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i> <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>

            <?php if(session('error')): ?>
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle"></i> <?php echo e(session('error')); ?>

                </div>
            <?php endif; ?>

            <?php echo $__env->yieldContent('content'); ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <?php echo $__env->yieldContent('extra-js'); ?>
</body>
</html>
<?php /**PATH D:\Laravel-Projects\e-commerce-system\fruit-shop\resources\views/layouts/admin.blade.php ENDPATH**/ ?>