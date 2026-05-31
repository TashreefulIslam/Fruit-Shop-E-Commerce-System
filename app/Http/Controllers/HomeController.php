<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;

class HomeController extends Controller
{
    /**
     * Show the home page.
     */
    public function index()
    {
        $featuredProducts = Product::inRandomOrder()
            ->limit(6)
            ->get();
        
        $latestProducts = Product::latest()
            ->limit(8)
            ->get();
        
        $categories = Category::with('products')
            ->limit(6)
            ->get();

        return view('home', compact('featuredProducts', 'latestProducts', 'categories'));
    }
}
