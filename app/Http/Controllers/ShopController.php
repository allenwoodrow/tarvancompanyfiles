<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query()->where(function($q) {
            // Products that have stock in main table OR have variants with stock
            $q->where('stock', '>', 0)
              ->orWhereHas('variants', function($variantQuery) {
                  $variantQuery->where('stock', '>', 0);
              });
        });
        
        // Search filter
        if ($request->has('search') && $request->search) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }
        
        // Category filter
        if ($request->has('category') && $request->category) {
            $query->where('category', $request->category);
        }
        
        // Price filter
        if ($request->has('min_price') && $request->min_price) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->has('max_price') && $request->max_price) {
            $query->where('price', '<=', $request->max_price);
        }
        
        // Color filter - now checking both product color and variant colors
        if ($request->has('color') && $request->color) {
            $query->where(function($q) use ($request) {
                $q->where('color', $request->color)
                  ->orWhereHas('variants', function($variantQuery) use ($request) {
                      $variantQuery->where('color', $request->color);
                  });
            });
        }
        
        // Size filter - now checking both product size and variant sizes
        if ($request->has('size') && $request->size) {
            $query->where(function($q) use ($request) {
                $q->where('size', $request->size)
                  ->orWhereHas('variants', function($variantQuery) use ($request) {
                      $variantQuery->where('size', $request->size);
                  });
            });
        }
        
        // Sorting
        $sort = $request->get('sort', 'newest');
        switch ($sort) {
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
                break;
        }
        
        $products = $query->with('variants')->paginate(12);
        
        // Get filter options including variants data
        $categories = Product::where(function($q) {
                $q->where('stock', '>', 0)
                  ->orWhereHas('variants', function($variantQuery) {
                      $variantQuery->where('stock', '>', 0);
                  });
            })
            ->distinct()
            ->whereNotNull('category')
            ->pluck('category')
            ->filter()
            ->values()
            ->toArray();
            
        // Get colors from both products and variants
        $productColors = Product::where(function($q) {
                $q->where('stock', '>', 0)
                  ->orWhereHas('variants', function($variantQuery) {
                      $variantQuery->where('stock', '>', 0);
                  });
            })
            ->whereNotNull('color')
            ->pluck('color')
            ->filter()
            ->toArray();
            
        $variantColors = ProductVariant::where('stock', '>', 0)
            ->whereNotNull('color')
            ->pluck('color')
            ->filter()
            ->toArray();
            
        $colors = array_unique(array_merge($productColors, $variantColors));
        sort($colors);
        
        // Get sizes from both products and variants
        $productSizes = Product::where(function($q) {
                $q->where('stock', '>', 0)
                  ->orWhereHas('variants', function($variantQuery) {
                      $variantQuery->where('stock', '>', 0);
                  });
            })
            ->whereNotNull('size')
            ->pluck('size')
            ->filter()
            ->toArray();
            
        $variantSizes = ProductVariant::where('stock', '>', 0)
            ->whereNotNull('size')
            ->pluck('size')
            ->filter()
            ->toArray();
            
        $sizes = array_unique(array_merge($productSizes, $variantSizes));
        sort($sizes);
        
        // Get counts for filters
        $categoryCounts = Product::where(function($q) {
                $q->where('stock', '>', 0)
                  ->orWhereHas('variants', function($variantQuery) {
                      $variantQuery->where('stock', '>', 0);
                  });
            })
            ->whereNotNull('category')
            ->groupBy('category')
            ->selectRaw('category, count(*) as count')
            ->pluck('count', 'category')
            ->toArray();
        
        // Color counts (simplified approach)
        $colorCounts = [];
        foreach ($colors as $color) {
            $count = Product::where(function($q) use ($color) {
                    $q->where(function($q2) use ($color) {
                        $q2->where('stock', '>', 0)
                           ->where('color', $color);
                    })
                    ->orWhereHas('variants', function($variantQuery) use ($color) {
                        $variantQuery->where('stock', '>', 0)
                                    ->where('color', $color);
                    });
                })
                ->count();
            $colorCounts[$color] = $count;
        }
        
        // Size counts (simplified approach)
        $sizeCounts = [];
        foreach ($sizes as $size) {
            $count = Product::where(function($q) use ($size) {
                    $q->where(function($q2) use ($size) {
                        $q2->where('stock', '>', 0)
                           ->where('size', $size);
                    })
                    ->orWhereHas('variants', function($variantQuery) use ($size) {
                        $variantQuery->where('stock', '>', 0)
                                    ->where('size', $size);
                    });
                })
                ->count();
            $sizeCounts[$size] = $count;
        }
        
        $maxPrice = Product::where(function($q) {
                $q->where('stock', '>', 0)
                  ->orWhereHas('variants', function($variantQuery) {
                      $variantQuery->where('stock', '>', 0);
                  });
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
        // Only show product if it has stock in main table OR variants
        if ($product->stock <= 0 && (!$product->variants || $product->variants->where('stock', '>', 0)->count() === 0)) {
            abort(404, 'Product not available');
        }
        
        // Get related products that have stock
        $relatedProducts = Product::where('category', $product->category)
            ->where('id', '!=', $product->id)
            ->where(function($q) {
                $q->where('stock', '>', 0)
                  ->orWhereHas('variants', function($variantQuery) {
                      $variantQuery->where('stock', '>', 0);
                  });
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