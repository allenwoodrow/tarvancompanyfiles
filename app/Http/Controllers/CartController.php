<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $cart = Cart::getCart($request);
        $cart->load('items.product');

        return view('cart.index', compact('cart'));
    }

    public function getCartData(Request $request)
    {
        try {
            if (!Auth::check()) {
                return response()->json([
                    'success' => true,
                    'cart' => [
                        'items' => [],
                        'subtotal' => 0,
                        'total' => 0,
                        'count' => 0
                    ],
                    'cart_count' => 0,
                    'is_authenticated' => false
                ]);
            }

            $cart = Cart::getCart($request);
            $cart->load('items.product');

            return response()->json([
                'success' => true,
                'cart' => $this->formatCartData($cart),
                'cart_count' => $cart->items->count(),
                'is_authenticated' => true
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching cart data: ' . $e->getMessage()
            ], 500);
        }
    }

    public function add(Request $request)
    {
        // If not authenticated - respond with JSON for AJAX or redirect for normal requests
        if (!Auth::check()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Please login to add items to cart',
                    'redirect' => route('login')
                ], 401);
            }
            return redirect()->route('login')->with('error', 'Please login to add items to your cart.');
        }

        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'nullable|integer|min:1',
            'size' => 'nullable|string',
            'color' => 'nullable|string'
        ]);

        DB::beginTransaction();

        try {
            $cart = Cart::getCart($request);
            $product = Product::findOrFail($request->product_id);
            $quantity = $request->quantity ?: 1;

            $existingItem = $cart->items()
                ->where('product_id', $product->id)
                ->where('size', $request->size)
                ->where('color', $request->color)
                ->first();

            if ($existingItem) {
                $existingItem->update([
                    'quantity' => $existingItem->quantity + $quantity
                ]);
            } else {
                CartItem::create([
                    'cart_id' => $cart->id,
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'price' => $product->price,
                    'size' => $request->size,
                    'color' => $request->color
                ]);
            }

            $cart->updateTotals();
            $cart->load('items.product');

            DB::commit();

            return response()->json([
                'success' => true,
                'cart' => $this->formatCartData($cart),
                'cart_count' => $cart->items->count(),
                'message' => 'Product added to cart successfully!'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error adding product to cart: ' . $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'nullable|integer|min:1',
            'size' => 'nullable|string',
            'color' => 'nullable|string'
        ]);

        DB::beginTransaction();

        try {
            $cart = Cart::getCart($request);
            $item = $cart->items()->findOrFail($id);

            if ($request->has('quantity')) {
                $item->update(['quantity' => max(1, $request->quantity)]);
            }

            if ($request->has('size')) {
                $item->update(['size' => $request->size]);
            }

            if ($request->has('color')) {
                $item->update(['color' => $request->color]);
            }

            $cart->updateTotals();
            $cart->load('items.product');

            DB::commit();

            return response()->json([
                'success' => true,
                'cart' => $this->formatCartData($cart),
                'cart_count' => $cart->items->count(),
                'message' => 'Cart updated successfully'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error updating cart item: ' . $e->getMessage()
            ], 500);
        }
    }

    public function remove(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            $cart = Cart::getCart($request);
            $item = $cart->items()->findOrFail($id);
            $item->delete();

            $cart->updateTotals();
            $cart->load('items.product');

            DB::commit();

            return response()->json([
                'success' => true,
                'cart' => $this->formatCartData($cart),
                'cart_count' => $cart->items->count(),
                'message' => 'Product removed from cart successfully!'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error removing product from cart: ' . $e->getMessage()
            ], 500);
        }
    }

    public function clear(Request $request)
    {
        DB::beginTransaction();

        try {
            $cart = Cart::getCart($request);
            $cart->items()->delete();
            $cart->updateTotals();

            DB::commit();

            return response()->json([
                'success' => true,
                'cart' => $this->formatCartData($cart),
                'cart_count' => 0,
                'message' => 'Cart cleared successfully!'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error clearing cart: ' . $e->getMessage()
            ], 500);
        }
    }

    private function formatCartData($cart)
    {
        return [
            'items' => $cart->items->map(function ($item) {
                return [
                    'id' => $item->id,
                    'product_id' => $item->product_id,
                    'name' => $item->product->name ?? 'Item',
                    'price' => (float) $item->price,
                    'quantity' => $item->quantity,
                    'size' => $item->size,
                    'color' => $item->color,
                    'image' => $item->product && $item->product->image ? asset($item->product->image) : asset('assets/images/default.jpg'),
                    'total' => (float) ($item->price * $item->quantity)
                ];
            })->keyBy('id'),
            'subtotal' => (float) $cart->subtotal,
            'total' => (float) $cart->subtotal,
            'count' => $cart->items->count()
        ];
    }
}
