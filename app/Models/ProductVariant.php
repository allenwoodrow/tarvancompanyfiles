<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id', 'color', 'size', 'stock', 'price', 'sku', 'image'
    ];

    protected $casts = [
        'price' => 'decimal:2',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getFinalPriceAttribute()
    {
        return $this->price ?? $this->product->price;
    }

    // Generate SKU automatically
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($variant) {
            if (empty($variant->sku)) {
                $variant->sku = self::generateSku($variant);
            }
        });
    }

    public static function generateSku($variant)
    {
        $productCode = substr(strtoupper(str_replace(' ', '', $variant->product->name)), 0, 5);
        $colorCode = substr(strtoupper($variant->color), 0, 3);
        $sizeCode = strtoupper($variant->size);
        
        return "{$productCode}-{$colorCode}-{$sizeCode}";
    }
}