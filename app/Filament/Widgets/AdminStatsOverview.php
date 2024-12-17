<?php

namespace App\Filament\Widgets;

use App\Models\Transaction;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;


class AdminStatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $today = Transaction::whereDay('created_at', date('d'));
        // dd($today);

        return [
            Stat::make('Transactions Today', $today->count()),
            Stat::make('Revenue Today', $today->get()->sum('grand_total')),

        ];
    }
}