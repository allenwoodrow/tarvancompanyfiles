<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalUsers = User::count();
        $totalProducts = Product::count();
        $totalOrders = Order::count();

        return view('admin.dashboard', compact('totalUsers', 'totalProducts', 'totalOrders'));
    }
}
