<?php

namespace App\Filament\Resources\OrderResource\Widgets;

use App\Models\Order;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Number;

class OrderOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('New Orders',Order::query()->where('status','new')->count()),
            Stat::make('Order Processing',Order::query()->where('status','processing')->count()),
            Stat::make('Order Shipped',Order::query()->where('status','shipped')->count()),
            Stat::make('Order Delivered',Order::query()->where('status','delivered')->count()),
            Stat::make('Order Canceled',Order::query()->where('status','canceled')->count()),
            Stat::make('Average Price',Number::currency(Order::query()->where('payment_status','paid')->avg('grand_total'),'IDR')),
        ];
    }
    
}
