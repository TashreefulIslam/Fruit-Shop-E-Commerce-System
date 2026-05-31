<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display all categories with products.
     */
    public function index()
    {
        $categories = Category::with('products')->get();
        return view('categories.index', compact('categories'));
    }

    /**
     * Display products for a specific category.
     */
    public function show($id)
    {
        $category = Category::findOrFail($id);
        $products = $category->products()->paginate(12);
        $categories = Category::all();
        
        return view('products.category', compact('category', 'products', 'categories'));
    }
}
