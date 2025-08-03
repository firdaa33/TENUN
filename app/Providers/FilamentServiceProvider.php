<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Illuminate\Support\ServiceProvider;

class FilamentServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Filament::serving(function () {
            Filament::registerTheme(mix('css/app.css'));
        });

        // Membatasi siapa yang boleh login ke Filament
        Filament::auth(function ($request) {
            // Contoh: hanya user dengan email tertentu
            return $request->user()
                && $request->user()->email === 'pringgaselatimurtenun@gmail.com';
        });
    }
}
