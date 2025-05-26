<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Number;

class OrderStatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        // Total Orders
        $totalOrders = Order::count();

        // Total Revenue
        $totalRevenue = Order::where('payment_status', 'paid')->sum('grand_total');

        // Pending Orders
        $pendingOrders = Order::where('status', 'new')->count();

        // Today's Orders
        $todayOrders = Order::whereDate('created_at', today())->count();

        // This Month Revenue
        $monthlyRevenue = Order::where('payment_status', 'paid')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('grand_total');

        // Orders Growth (comparing this month to last month)
        $thisMonthOrders = Order::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        $lastMonthOrders = Order::whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', now()->subMonth()->year)
            ->count();

        $ordersGrowth = $lastMonthOrders > 0
            ? (($thisMonthOrders - $lastMonthOrders) / $lastMonthOrders) * 100
            : 0;

        return [
            Stat::make('Total Pesanan', $totalOrders)
                ->description('Semua pesanan')
                ->descriptionIcon('heroicon-m-shopping-bag')
                ->color('primary'),

            Stat::make('Total Pendapatan', Number::currency($totalRevenue, 'IDR'))
                ->description('Pendapatan yang sudah dibayar')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('success'),

            Stat::make('Pesanan Pending', $pendingOrders)
                ->description('Menunggu diproses')
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning'),

            Stat::make('Pesanan Hari Ini', $todayOrders)
                ->description('Pesanan masuk hari ini')
                ->descriptionIcon('heroicon-m-calendar-days')
                ->color('info'),

            Stat::make('Pendapatan Bulan Ini', Number::currency($monthlyRevenue, 'IDR'))
                ->description('Pendapatan bulan berjalan')
                ->descriptionIcon('heroicon-m-chart-bar')
                ->color('success'),

            Stat::make('Pertumbuhan Pesanan', number_format($ordersGrowth, 1) . '%')
                ->description($ordersGrowth >= 0 ? 'Naik dari bulan lalu' : 'Turun dari bulan lalu')
                ->descriptionIcon($ordersGrowth >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')
                ->color($ordersGrowth >= 0 ? 'success' : 'danger'),
        ];
    }
}
