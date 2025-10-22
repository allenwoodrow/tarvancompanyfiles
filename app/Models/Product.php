<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'category', 'description', 'image', 'price', 'old_price'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'old_price' => 'decimal:2',
    ];

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function availableColors()
    {
        return $this->variants()->distinct()->pluck('color');
    }

    public function availableSizes($color = null)
    {
        $query = $this->variants()->where('stock', '>', 0);
        if ($color) {
            $query->where('color', $color);
        }
        return $query->distinct()->pluck('size');
    }

    public function getTotalStockAttribute()
    {
        return $this->variants->sum('stock');
    }

    public function getMinPriceAttribute()
    {
        return $this->variants->min('price') ?? $this->price;
    }

    public function getMaxPriceAttribute()
    {
        return $this->variants->max('price') ?? $this->price;
    }

    public function getVariant($color, $size)
    {
        return $this->variants()
            ->where('color', $color)
            ->where('size', $size)
            ->first();
    }
}