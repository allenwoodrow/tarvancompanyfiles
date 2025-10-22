<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'order_number',
        'status',
        'subtotal',
        'shipping',
        'total',
        'shipping_address',
        'billing_address',
        'payment_method',
        'notes'
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
        'shipping' => 'decimal:2',
        'total' => 'decimal:2',
    ];

    // Improved accessor for shipping address
    public function getShippingAddressAttribute($value)
    {
        if (is_array($value)) {
            return $value;
        }
        
        $decoded = json_decode($value, true);
        return json_last_error() === JSON_ERROR_NONE ? $decoded : $value;
    }

    // Improved accessor for billing address
    public function getBillingAddressAttribute($value)
    {
        if (is_array($value)) {
            return $value;
        }
        
        $decoded = json_decode($value, true);
        return json_last_error() === JSON_ERROR_NONE ? $decoded : $value;
    }

    // Relationship with user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship with order items
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Relationship with payment
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    // Calculate total items in order
    public function getTotalItemsAttribute()
    {
        return $this->items->sum('quantity');
    }

    // Accessor for formatted order number
    public function getFormattedOrderNumberAttribute()
    {
        return 'ORD-' . strtoupper($this->order_number);
    }

    // Check if addresses are arrays
    public function getShippingAddressIsArrayAttribute()
    {
        return is_array($this->shipping_address);
    }

    public function getBillingAddressIsArrayAttribute()
    {
        return is_array($this->billing_address);
    }
}