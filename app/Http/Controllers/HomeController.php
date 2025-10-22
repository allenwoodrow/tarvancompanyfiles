<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // public function index()
    // {
    //     $products = Product::all(); // fetch all products
    //     return view('home', compact('products'));
    // }

    public function index()
    {
        $products = Product::where('stock', '>', 0)->latest()->take(8)->get();
        $newArrivals = Product::where('stock', '>', 0)->latest()->take(4)->get();
        
        return view('home', compact('products', 'newArrivals'));
    }

    public function shop()
    {
        $products = Product::all(); // fetch all products
        return view('shop', compact('products'));
    }
}
