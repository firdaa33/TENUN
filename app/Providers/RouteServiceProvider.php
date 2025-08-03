<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Ini menentukan redirect setelah login.
     * Ganti '/checkout' sesuai alur kamu.
     */
    public const HOME = '/checkout';

    public function boot(): void
    {
        parent::boot();
    }
}
