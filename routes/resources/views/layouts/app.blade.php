<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Fruit Shop - Premium E-Commerce')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #FF6B35;
            --secondary-color: #004E89;
            --light-color: #F8F9FA;
            --dark-color: #1A1A1A;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
        }

        /* Navigation */
        .navbar {
            background: linear-gradient(135deg, var(--secondary-color) 0%, var(--primary-color) 100%);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            padding: 1rem 0;
        }

        .navbar-brand {
            font-size: 1.8rem;
            font-weight: 700;
            color: white !important;
            letter-spacing: 1px;
        }

        .navbar-brand i {
            color: var(--primary-color);
            margin-right: 5px;
        }

        .nav-link {
            color: white !important;
            margin: 0 10px;
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-link:hover {
            color: var(--primary-color) !important;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -5px;
            left: 0;
            background-color: var(--primary-color);
            transition: width 0.3s ease;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        .navbar-toggler {
            border-color: white;
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='white' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }

        /* Main Container */
        .container-fluid {
            max-width: 1400px;
            margin: 0 auto;
        }

        /* Buttons */
        .btn-primary {
            background: linear-gradient(135deg, var(--secondary-color) 0%, var(--primary-color) 100%);
            border: none;
            padding: 0.6rem 1.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(255, 107, 53, 0.3);
            color: white;
        }

        .btn-outline-primary {
            border: 2px solid var(--primary-color);
            color: var(--primary-color);
        }

        .btn-outline-primary:hover {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        /* Cards */
        .card {
            border: none;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            border-radius: 12px;
            overflow: hidden;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        }

        /* Product Card */
        .product-card {
            position: relative;
            overflow: hidden;
        }

        .product-image {
            height: 250px;
            overflow: hidden;
            background-color: #f0f0f0;
            position: relative;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .product-card:hover .product-image img {
            transform: scale(1.1);
        }

        .product-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background: var(--primary-color);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .product-info {
            padding: 1.5rem;
        }

        .product-name {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 0.5rem;
            text-decoration: none;
        }

        .product-name:hover {
            color: var(--primary-color);
        }

        .product-price {
            font-size: 1.5rem;
            color: var(--primary-color);
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .product-stock {
            font-size: 0.9rem;
            color: #666;
            margin-bottom: 1rem;
        }

        /* Forms */
        .form-control, .form-select {
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(255, 107, 53, 0.25);
        }

        /* Alerts */
        .alert {
            border-radius: 10px;
            border: none;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }

        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
        }

        /* Footer */
        footer {
            background: linear-gradient(135deg, var(--secondary-color) 0%, var(--primary-color) 100%);
            color: white;
            padding: 3rem 0 1rem;
            margin-top: 5rem;
        }

        footer h5 {
            font-weight: 700;
            margin-bottom: 1.5rem;
            color: white;
        }

        footer a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: all 0.3s ease;
        }

        footer a:hover {
            color: white;
            padding-left: 5px;
        }

        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.2);
            padding-top: 2rem;
            margin-top: 2rem;
            text-align: center;
        }

        /* Cart Badge */
        .cart-badge {
            position: absolute;
            top: -10px;
            right: -10px;
            background: var(--primary-color);
            color: white;
            border-radius: 50%;
            width: 25px;
            height: 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
            font-weight: 700;
        }

        .cart-link {
            position: relative;
            display: inline-block;
        }

        /* Pagination */
        .pagination {
            justify-content: center;
        }

        .page-link {
            color: var(--primary-color);
            border-color: #dee2e6;
        }

        .page-link:hover {
            color: white;
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .page-item.active .page-link {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        /* Breadcrumb */
        .breadcrumb {
            background-color: transparent;
            padding: 1rem 0;
        }

        .breadcrumb-item.active {
            color: var(--primary-color);
            font-weight: 600;
        }

        /* Main Content */
        .main-content {
            min-height: 70vh;
            padding: 2rem 0;
        }

        /* Badge */
        .badge {
            padding: 0.5rem 0.75rem;
            border-radius: 50px;
        }

        .badge-primary {
            background: var(--primary-color);
        }

        /* Table */
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

        .table tbody tr {
            transition: all 0.2s ease;
        }

        .table tbody tr:hover {
            background-color: var(--light-color);
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 3rem 1rem;
        }

        .empty-state i {
            font-size: 4rem;
            color: #ccc;
            margin-bottom: 1rem;
        }

        .empty-state p {
            color: #999;
            font-size: 1.1rem;
        }

        /* Spinner */
        .spinner-border {
            color: var(--primary-color);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .product-image {
                height: 200px;
            }

            .product-price {
                font-size: 1.2rem;
            }

            .navbar-brand {
                font-size: 1.3rem;
            }
        }
    </style>
    @yield('extra-css')
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('home') }}">
                <i class="fas fa-leaf"></i>Fruit Shop
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('products.index') }}">Products</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            Categories
                        </a>
                        <ul class="dropdown-menu">
                            @foreach($categories ?? [] as $category)
                                <li>
                                    <a class="dropdown-item" href="{{ route('categories.show', $category->id) }}">
                                        {{ $category->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('products.search') }}" method="GET" class="d-flex ms-2">
                            <div class="input-group">
                                <input class="form-control" type="search" name="q" placeholder="Search products...">
                                <button class="btn btn-outline-light" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </form>
                    </li>
                    @auth
                        @if(auth()->user()->isAdmin())
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.dashboard') }}">Admin</a>
                            </li>
                        @endif
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('orders.index') }}">My Orders</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link cart-link" href="{{ route('cart.index') }}">
                                <i class="fas fa-shopping-cart"></i>
                                Cart
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('profile.show') }}">Profile</a>
                        </li>
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                                @csrf
                                <button class="nav-link btn btn-link" type="submit">Logout</button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Register</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="main-content">
        <div class="container-fluid">
            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong>
                    @foreach($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3 mb-4">
                    <h5><i class="fas fa-leaf"></i> Fruit Shop</h5>
                    <p>Your premium destination for fresh and quality fruits delivered right to your door.</p>
                </div>
                <div class="col-md-3 mb-4">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('products.index') }}">Products</a></li>
                        @auth
                            <li><a href="{{ route('orders.index') }}">My Orders</a></li>
                            <li><a href="{{ route('cart.index') }}">Cart</a></li>
                        @endauth
                    </ul>
                </div>
                <div class="col-md-3 mb-4">
                    <h5>Customer Service</h5>
                    <ul class="list-unstyled">
                        <li><a href="#">Contact Us</a></li>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Shipping Info</a></li>
                        <li><a href="#">Returns</a></li>
                    </ul>
                </div>
                <div class="col-md-3 mb-4">
                    <h5>Follow Us</h5>
                    <div>
                        <a href="#" class="me-3"><i class="fab fa-facebook-f fa-lg"></i></a>
                        <a href="#" class="me-3"><i class="fab fa-twitter fa-lg"></i></a>
                        <a href="#" class="me-3"><i class="fab fa-instagram fa-lg"></i></a>
                        <a href="#"><i class="fab fa-youtube fa-lg"></i></a>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2024 Fruit Shop. All rights reserved. | <a href="#">Privacy Policy</a> | <a href="#">Terms of Service</a></p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('extra-js')
</body>
</html>
