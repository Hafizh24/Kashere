<?php

namespace App\Filament\Widgets;

use App\Models\Transaction;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Number;

class AdminStatsOverview extends BaseWidget
{
    protected static ?int $sort = 0;

    protected function getStats(): array
    {
        $today = Transaction::whereDay('created_at', date('d'));
        // dd($today);

        return [
            Stat::make('Transactions Today', $today->count()),
            Stat::make('Revenue Today', Number::currency($today->get()->sum('grand_total'), 'IDR')),

        ];
    }
}