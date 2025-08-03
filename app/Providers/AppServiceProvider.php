<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
   public function boot(): void
{
    View::composer('*', function ($view) {
        $cart = session()->get('cart', []);
        
        // Pakai collect dan filter yang aman
        $cartCount = collect($cart)->reduce(function ($carry, $item) {
            return $carry + ($item['quantity'] ?? 0); // Aman meskipun key 'quantity' tidak ada
        }, 0);

        $view->with('cartCount', $cartCount);
    });
}
}
