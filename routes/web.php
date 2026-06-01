<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');

// Product Routes
Route::get('/shop', [ProductController::class, 'index'])->name('products.index');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('products.show');
Route::get('/search', [ProductController::class, 'search'])->name('products.search');

// Category Routes
Route::get('/category/{id}', [CategoryController::class, 'show'])->name('categories.show');

// Authentication Routes
Route::middleware('auth')->group(function () {
    // Cart Routes
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::put('/cart/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::delete('/cart', [CartController::class, 'clear'])->name('cart.clear');

    // Order Routes
    Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout.index');
    Route::post('/checkout', [OrderController::class, 'placeOrder'])->name('order.place');
    Route::get('/order/success/{id}', [OrderController::class, 'success'])->name('order.success');
    Route::get('/orders', [OrderController::class, 'myOrders'])->name('orders.index');
    Route::get('/order/{id}', [OrderController::class, 'show'])->name('orders.show');

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Categories
    Route::resource('categories', AdminCategoryController::class);

    // Products
    Route::resource('products', AdminProductController::class);

    // Orders
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::get('/order/{id}', [AdminOrderController::class, 'show'])->name('orders.show');
    Route::put('/order/{id}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.updateStatus');
});

require __DIR__.'/auth.php';
