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
        if (auth()->check()) {
            // Use persistent cart for logged-in user
            return static::firstOrCreate(['user_id' => auth()->id()]);
        }

        // For guest users, bind to session_id
        $sessionId = session()->getId();

        return static::firstOrCreate(['session_id' => $sessionId]);
    }


    /**
     * Update cart totals based on items
     */
    public function updateTotals()
    {
        $subtotal = $this->items->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        // Calculate shipping (example: $5 flat rate)
        $shipping = 5.00;
        
        $total = $subtotal + $shipping;

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