<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'session_id',
        'subtotal',
        'shipping',
        'total'
    ];

    public function items()
    {
        return $this->hasMany(CartItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get or create cart for the current user/session
     */
    public static function getCart($request)
    {
        // If user is logged in, use or create user's cart and merge session cart (if any)
        if (Auth::check()) {
            $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);

            if ($request->session()->has('cart_id')) {
                $sessionCart = Cart::find($request->session()->get('cart_id'));
                if ($sessionCart && $sessionCart->id !== $cart->id) {
                    foreach ($sessionCart->items as $item) {
                        $existing = $cart->items()
                            ->where('product_id', $item->product_id)
                            ->where('size', $item->size)
                            ->where('color', $item->color)
                            ->first();

                        if ($existing) {
                            $existing->quantity += $item->quantity;
                            $existing->save();
                        } else {
                            $item->update(['cart_id' => $cart->id]);
                        }
                    }
                    $sessionCart->delete();
                    $request->session()->forget('cart_id');
                }
            }
            return $cart;
        }

        // Guest: use session-based cart
        if ($request->session()->has('cart_id')) {
            $cart = Cart::find($request->session()->get('cart_id'));
            if ($cart) return $cart;
        }

        $cart = Cart::create(['session_id' => session()->getId(), 'subtotal' => 0, 'shipping' => 0, 'total' => 0]);
        $request->session()->put('cart_id', $cart->id);

        return $cart;
    }

    /**
     * Update cart totals based on items - NO SHIPPING
     */
    public function updateTotals()
    {
        // Make sure items are loaded
        $this->loadMissing('items');

        $subtotal = $this->items->sum(function ($item) {
            return ($item->price * $item->quantity);
        });

        $shipping = 0.00;
        $total = $subtotal;

        $this->update([
            'subtotal' => $subtotal,
            'shipping' => $shipping,
            'total' => $total
        ]);

        return $this;
    }

    /**
     * Clear all items from cart
     */
    public function clear()
    {
        $this->items()->delete();
        $this->updateTotals();
        return $this;
    }
}
