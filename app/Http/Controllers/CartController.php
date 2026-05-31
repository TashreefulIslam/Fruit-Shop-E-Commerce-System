<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display cart items.
     */
    public function index()
    {
        $cartItems = Cart::where('user_id', auth()->id())
            ->with('product')
            ->get();
        
        $total = $cartItems->sum(function($item) {
            return $item->product->price * $item->quantity;
        });

        return view('cart.index', compact('cartItems', 'total'));
    }

    /**
     * Add product to cart.
     */
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);

        // Check if product is in stock
        if ($product->stock < $request->quantity) {
            return back()->with('error', 'Not enough stock available!');
        }

        // Check if product already in cart
        $cartItem = Cart::where('user_id', auth()->id())
            ->where('product_id', $request->product_id)
            ->first();

        if ($cartItem) {
            // Update quantity
            if ($product->stock < $cartItem->quantity + $request->quantity) {
                return back()->with('error', 'Not enough stock available!');
            }
            $cartItem->update([
                'quantity' => $cartItem->quantity + $request->quantity
            ]);
        } else {
            // Create new cart item
            Cart::create([
                'user_id' => auth()->id(),
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
            ]);
        }

        return back()->with('success', 'Product added to cart!');
    }

    /**
     * Update cart item quantity.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cartItem = Cart::findOrFail($id);
        
        // Verify cart item belongs to authenticated user
        if ($cartItem->user_id !== auth()->id()) {
            return back()->with('error', 'Unauthorized access!');
        }

        // Check stock
        if ($cartItem->product->stock < $request->quantity) {
            return back()->with('error', 'Not enough stock available!');
        }

        $cartItem->update(['quantity' => $request->quantity]);

        return back()->with('success', 'Cart updated!');
    }

    /**
     * Remove item from cart.
     */
    public function remove($id)
    {
        $cartItem = Cart::findOrFail($id);
        
        // Verify cart item belongs to authenticated user
        if ($cartItem->user_id !== auth()->id()) {
            return back()->with('error', 'Unauthorized access!');
        }

        $cartItem->delete();

        return back()->with('success', 'Item removed from cart!');
    }

    /**
     * Clear entire cart.
     */
    public function clear()
    {
        Cart::where('user_id', auth()->id())->delete();
        
        return back()->with('success', 'Cart cleared!');
    }
}
