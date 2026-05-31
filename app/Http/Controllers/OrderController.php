<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Show checkout page.
     */
    public function checkout()
    {
        $cartItems = Cart::where('user_id', auth()->id())
            ->with('product')
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect('/cart')->with('error', 'Your cart is empty!');
        }

        $total = $cartItems->sum(function($item) {
            return $item->product->price * $item->quantity;
        });

        return view('checkout.index', compact('cartItems', 'total'));
    }

    /**
     * Place order.
     */
    public function placeOrder(Request $request)
    {
        $request->validate([
            'phone' => 'required|string',
            'address' => 'required|string',
        ]);

        $cartItems = Cart::where('user_id', auth()->id())
            ->with('product')
            ->get();

        if ($cartItems->isEmpty()) {
            return back()->with('error', 'Your cart is empty!');
        }

        // Calculate total
        $totalPrice = 0;
        foreach ($cartItems as $item) {
            // Check stock before placing order
            if ($item->product->stock < $item->quantity) {
                return back()->with('error', "Not enough stock for {$item->product->name}!");
            }
            $totalPrice += $item->product->price * $item->quantity;
        }

        try {
            // Create order
            $order = Order::create([
                'user_id' => auth()->id(),
                'phone' => $request->phone,
                'address' => $request->address,
                'total_price' => $totalPrice,
                'status' => 'Pending',
            ]);

            // Create order items and update stock
            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price,
                ]);

                // Reduce stock
                $item->product->update([
                    'stock' => $item->product->stock - $item->quantity,
                ]);
            }

            // Clear cart
            Cart::where('user_id', auth()->id())->delete();

            return redirect()->route('order.success', $order->id)
                ->with('success', 'Order placed successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to place order. Please try again.');
        }
    }

    /**
     * Show order success page.
     */
    public function success($orderId)
    {
        $order = Order::findOrFail($orderId);
        
        // Verify order belongs to authenticated user
        if ($order->user_id !== auth()->id()) {
            return redirect('/')->with('error', 'Unauthorized access!');
        }

        return view('checkout.success', compact('order'));
    }

    /**
     * Show user's orders.
     */
    public function myOrders()
    {
        $orders = Order::where('user_id', auth()->id())
            ->with('items.product')
            ->latest()
            ->paginate(10);

        return view('orders.index', compact('orders'));
    }

    /**
     * Show order details.
     */
    public function show($id)
    {
        $order = Order::with('items.product', 'user')->findOrFail($id);

        // Verify order belongs to authenticated user
        if ($order->user_id !== auth()->id()) {
            return redirect('/')->with('error', 'Unauthorized access!');
        }

        return view('orders.show', compact('order'));
    }
}
