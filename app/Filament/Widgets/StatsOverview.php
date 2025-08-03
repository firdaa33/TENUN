<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use App\Models\Product;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class StatsOverview extends StatsOverviewWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('Total Produk', Product::count()),
            Card::make('Total Penjualan', 'Rp ' . number_format(Order::sum('total_price'), 0, ',', '.')),
            Card::make('Pesanan Baru', Order::where('status', 'pending')->count()),
        ];
    }
}
