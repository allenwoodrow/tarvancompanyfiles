<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['user', 'product', 'payment'])->latest()->get();
        return view('admin.orders.index', compact('orders'));
    }

    public function create()
    {
        $users = User::all();
        $products = Product::all();
        return view('admin.orders.create', compact('users', 'products'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'status' => 'required|string',
        ]);

        $product = Product::findOrFail($request->product_id);

        if ($request->quantity > $product->stock) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['quantity' => 'Requested quantity exceeds available stock.']);
        }

        $totalAmount = $product->price * $request->quantity;

        Order::create([
            'user_id' => $request->user_id,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'total_amount' => $totalAmount,
            'status' => $request->status,
            'billing_address' => $request->billing_address,
            'shipping_address' => $request->shipping_address,
        ]);

        // Optional: decrease stock now
        $product->stock -= $request->quantity;
        $product->save();

        return redirect()->route('admin.orders.index')->with('success', 'Order created successfully!');
    }


    public function edit(Order $order)
    {
        $users = User::all();
        $products = Product::all();
        return view('admin.orders.edit', compact('order', 'users', 'products'));
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'status' => 'required|string',
            'billing_address' => 'required|string',
            'shipping_address' => 'required|string',
        ]);

        $product = Product::findOrFail($request->product_id);

        $quantityChange = $request->quantity - $order->quantity; // difference

        if ($quantityChange > 0 && $quantityChange > $product->stock) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['quantity' => 'Requested quantity exceeds available stock.']);
        }

        $totalAmount = $product->price * $request->quantity;

        $order->update([
            'user_id' => $request->user_id,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'total_amount' => $totalAmount,
            'status' => $request->status,
            'billing_address' => $request->billing_address,
            'shipping_address' => $request->shipping_address,
        ]);

        // Adjust stock
        $product->stock -= $quantityChange;
        $product->save();

        return redirect()->route('admin.orders.index')->with('success', 'Order updated successfully!');
    }


    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('admin.orders.index')->with('success', 'Order deleted successfully!');
    }
}
