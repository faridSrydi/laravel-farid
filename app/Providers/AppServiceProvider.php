<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use App\Models\Category;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void {}

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // 1. Paksa HTTPS di production (Railway)
        if (app()->environment('production')) {
            URL::forceScheme('https');
        }

        // 2. FIX: Kirim data categories ke semua view (Header/Navbar)
        // Ini mencegah error "Undefined variable categories" di halaman Login/Register
        View::composer('*', function ($view) {
            $view->with('categories', Category::all());
        });

        // 3. Midtrans config
        \Midtrans\Config::$serverKey = config('services.midtrans.serverKey');
        \Midtrans\Config::$clientKey = config('services.midtrans.clientKey');
        \Midtrans\Config::$isProduction = config('services.midtrans.isProduction');
        \Midtrans\Config::$isSanitized = config('services.midtrans.isSanitized');
        \Midtrans\Config::$is3ds = config('services.midtrans.is3ds');
    }
}
