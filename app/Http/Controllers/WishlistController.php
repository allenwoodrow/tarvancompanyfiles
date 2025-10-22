<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlist = session()->get('wishlist', []);
        return view('wishlist.index', compact('wishlist'));
    }

    public function add($id)
    {
        $product = Product::findOrFail($id);

        $wishlist = session()->get('wishlist', []);

        $wishlist[$id] = [
            'name' => $product->name,
            'price' => $product->price,
            'image' => $product->image ? asset('storage/'.$product->image) : asset('assets/img/product/default.jpg'),
        ];

        session()->put('wishlist', $wishlist);

        return back()->with('success', 'Product added to wishlist!');
    }

    public function remove($id)
    {
        $wishlist = session()->get('wishlist', []);
        if (isset($wishlist[$id])) {
            unset($wishlist[$id]);
            session()->put('wishlist', $wishlist);
        }
        return back()->with('success', 'Product removed from wishlist!');
    }
}
