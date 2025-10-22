<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductVariant;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('variants')->latest()->get();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        // Remove 'stock' from validation since it's now handled by variants
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'old_price' => 'nullable|numeric|min:0',
            'image' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
            'variants' => 'required|array|min:1',
            'variants.*.color' => 'required|string|max:255',
            'variants.*.size' => 'required|string|max:50',
            'variants.*.stock' => 'required|integer|min:0',
            'variants.*.price' => 'nullable|numeric|min:0',
        ]);

        try {
            // Handle main image upload
            $mainImagePath = null;
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('products'), $filename);
                $mainImagePath = 'products/' . $filename;
            }

            // Create main product
            $product = Product::create([
                'name' => $request->name,
                'category' => $request->category,
                'description' => $request->description,
                'price' => $request->price,
                'old_price' => $request->old_price,
                'image' => $mainImagePath,
            ]);

            // Create variants
            foreach ($request->variants as $variantData) {
                ProductVariant::create([
                    'product_id' => $product->id,
                    'color' => $variantData['color'],
                    'size' => $variantData['size'],
                    'stock' => $variantData['stock'],
                    'price' => $variantData['price'] ?? null, // Use null if price is empty
                ]);
            }

            return redirect()->route('admin.products.index')
                ->with('success', 'Product with variants created successfully!');

        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('Product creation error: ' . $e->getMessage());
            
            return redirect()->back()
                ->withInput()
                ->with('error', 'Error creating product: ' . $e->getMessage());
        }
    }

    public function edit(Product $product)
    {
        $product->load('variants');
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        // Remove stock validation since it's handled by variants
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'old_price' => 'nullable|numeric|min:0',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'variants' => 'required|array|min:1',
            'variants.*.color' => 'required|string|max:255',
            'variants.*.size' => 'required|string|max:50',
            'variants.*.stock' => 'required|integer|min:0',
            'variants.*.price' => 'nullable|numeric|min:0',
        ]);

        try {
            $data = $request->only([
                'name', 'category', 'description', 'price', 'old_price'
            ]);

            // Handle image update
            if ($request->hasFile('image')) {
                // Delete old image
                if ($product->image && file_exists(public_path($product->image))) {
                    unlink(public_path($product->image));
                }
                
                $file = $request->file('image');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('products'), $filename);
                $data['image'] = 'products/' . $filename;
            }

            $product->update($data);

            // Update variants - delete existing and create new ones
            $product->variants()->delete();
            
            foreach ($request->variants as $variantData) {
                ProductVariant::create([
                    'product_id' => $product->id,
                    'color' => $variantData['color'],
                    'size' => $variantData['size'],
                    'stock' => $variantData['stock'],
                    'price' => $variantData['price'] ?? null,
                ]);
            }

            return redirect()->route('admin.products.index')
                ->with('success', 'Product updated successfully!');

        } catch (\Exception $e) {
            \Log::error('Product update error: ' . $e->getMessage());
            
            return redirect()->back()
                ->withInput()
                ->with('error', 'Error updating product: ' . $e->getMessage());
        }
    }

    public function destroy(Product $product)
    {
        try {
            // Delete image from /public/products
            if ($product->image && file_exists(public_path($product->image))) {
                unlink(public_path($product->image));
            }

            // Delete variants first
            $product->variants()->delete();
            $product->delete();

            return redirect()->route('admin.products.index')
                ->with('success', '🗑 Product deleted successfully!');

        } catch (\Exception $e) {
            \Log::error('Product deletion error: ' . $e->getMessage());
            
            return redirect()->back()
                ->with('error', 'Error deleting product: ' . $e->getMessage());
        }
    }
}