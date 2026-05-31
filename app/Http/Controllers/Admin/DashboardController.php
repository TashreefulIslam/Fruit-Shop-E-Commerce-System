<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\Category;

class DashboardController extends Controller
{
    /**
     * Show admin dashboard.
     */
    public function index()
    {
        $totalUsers = User::where('role', 'user')->count();
        $totalProducts = Product::count();
        $totalOrders = Order::count();
        $totalCategories = Category::count();
        
        $totalRevenue = Order::where('status', 'Delivered')
            ->sum('total_price');
        
        $recentOrders = Order::with('user')
            ->latest()
            ->take(5)
            ->get();
        
        $lowStockProducts = Product::where('stock', '<', 5)
            ->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalProducts',
            'totalOrders',
            'totalCategories',
            'totalRevenue',
            'recentOrders',
            'lowStockProducts'
        ));
    }
}
