<?php

namespace App\Filament\Widgets;

use Filament\Widgets\LineChartWidget;
use App\Models\Order;
use Illuminate\Support\Carbon;

class OrderChart extends LineChartWidget
{
    protected static ?string $heading = 'Penjualan Bulanan';

    protected function getData(): array
    {
        $data = collect(range(1, 12))->mapWithKeys(function ($month) {
            return [Carbon::create(null, $month)->format('F') => 0];
        });

        $orders = Order::selectRaw('MONTH(created_at) as month, SUM(total_price) as total')
            ->groupBy('month')
            ->get();

        foreach ($orders as $order) {
            $monthName = Carbon::create()->month($order->month)->format('F');
            $data[$monthName] = $order->total;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Total Penjualan',
                    'data' => array_values($data->toArray()),
                ],
            ],
            'labels' => array_keys($data->toArray()),
        ];
    }
}
