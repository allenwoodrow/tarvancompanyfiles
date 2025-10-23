<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        // Base query — only show available products or those with stocked variants
        $query = Product::query()->where(function ($q) {
            $q->where('stock', '>', 0)
              ->orWhereHas('variants', fn($v) => $v->where('stock', '>', 0));
        });

        // 🔍 Search Filter
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(fn($q) =>
                $q->where('name', 'like', "%$search%")
                  ->orWhere('description', 'like', "%$search%")
            );
        }

        // 🍛 Category Filter (e.g., Rice, Swallow, Soup, Snacks, Drinks)
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // 💰 Price Range Filter
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // 🎨 Color Filter — only from product_variants
        if ($request->filled('color')) {
            $color = $request->color;
            $query->whereHas('variants', fn($v) => $v->where('color', $color));
        }

        // 📏 Size Filter — only from product_variants
        if ($request->filled('size')) {
            $size = $request->size;
            $query->whereHas('variants', fn($v) => $v->where('size', $size));
        }

        // 🔄 Sorting
        switch ($request->get('sort', 'newest')) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'name_asc':
                $query->orderBy('name', 'asc');
                break;
            case 'name_desc':
                $query->orderBy('name', 'desc');
                break;
            default:
                $query->latest();
        }

        // Include variants in the result
        $products = $query->with('variants')->paginate(12);

        // 🏷️ Categories (unique + active)
        $categories = Product::where(function ($q) {
                $q->where('stock', '>', 0)
                  ->orWhereHas('variants', fn($v) => $v->where('stock', '>', 0));
            })
            ->distinct()
            ->whereNotNull('category')
            ->pluck('category')
            ->filter()
            ->values()
            ->toArray();

        // 🎨 All available colors (from variants only)
        $colors = ProductVariant::where('stock', '>', 0)
            ->whereNotNull('color')
            ->distinct()
            ->pluck('color')
            ->filter()
            ->values()
            ->toArray();

        // 📏 All available sizes (from variants only)
        $sizes = ProductVariant::where('stock', '>', 0)
            ->whereNotNull('size')
            ->distinct()
            ->pluck('size')
            ->filter()
            ->values()
            ->toArray();

        // 📊 Category Counts
        $categoryCounts = Product::where(function ($q) {
                $q->where('stock', '>', 0)
                  ->orWhereHas('variants', fn($v) => $v->where('stock', '>', 0));
            })
            ->selectRaw('category, COUNT(*) as count')
            ->groupBy('category')
            ->pluck('count', 'category')
            ->toArray();

        // 🎨 Color Counts
        $colorCounts = [];
        foreach ($colors as $color) {
            $colorCounts[$color] = Product::whereHas('variants', fn($v) =>
                $v->where('color', $color)->where('stock', '>', 0)
            )->count();
        }

        // 📏 Size Counts
        $sizeCounts = [];
        foreach ($sizes as $size) {
            $sizeCounts[$size] = Product::whereHas('variants', fn($v) =>
                $v->where('size', $size)->where('stock', '>', 0)
            )->count();
        }

        // 💰 Maximum price for slider
        $maxPrice = Product::where(function ($q) {
            $q->where('stock', '>', 0)
              ->orWhereHas('variants', fn($v) => $v->where('stock', '>', 0));
        })->max('price') ?: 1000;

        return view('shop', compact(
            'products',
            'categories',
            'colors',
            'sizes',
            'categoryCounts',
            'colorCounts',
            'sizeCounts',
            'maxPrice'
        ));
    }

    public function show(Product $product)
    {
        // Ensure product has stock or stocked variants
        if ($product->stock <= 0 && $product->variants()->where('stock', '>', 0)->count() === 0) {
            abort(404, 'Product not available');
        }

        $relatedProducts = Product::where('category', $product->category)
            ->where('id', '!=', $product->id)
            ->where(function ($q) {
                $q->where('stock', '>', 0)
                  ->orWhereHas('variants', fn($v) => $v->where('stock', '>', 0));
            })
            ->limit(4)
            ->get();

        return view('products.show', compact('product', 'relatedProducts'));
    }

    public function about()
    {
        return view('about');
    }
}
