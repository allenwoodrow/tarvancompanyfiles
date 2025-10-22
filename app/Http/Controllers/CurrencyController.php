<?php
// app/Http/Controllers/CurrencyController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    public function switch(Request $request)
    {
        $currency = $request->input('currency', 'USD'); // default USD
        session(['currency' => $currency]);

        return response()->json([
            'success' => true,
            'currency' => $currency
        ]);
    }
}
