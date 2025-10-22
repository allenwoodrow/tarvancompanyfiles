<?php
// app/Providers/CurrencyServiceProvider.php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;

class CurrencyServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        // Share currency data with all views
        View::composer('*', function ($view) {
            $currency = session('currency', 'USD');
            $exchangeRate = Cache::remember('usd_to_ngn', 3600, function () {
                return $this->fetchExchangeRate();
            });
            
            $view->with([
                'currentCurrency' => $currency,
                'exchangeRate' => $exchangeRate,
                'currencySymbol' => $currency === 'NGN' ? '₦' : '$'
            ]);
        });
    }

    private function fetchExchangeRate()
    {
        try {
            $response = file_get_contents('https://api.exchangerate-api.com/v4/latest/USD');
            $data = json_decode($response, true);
            return $data['rates']['NGN'] ?? 1500;
        } catch (\Exception $e) {
            return 1500; // Fallback rate
        }
    }
}