<?php

namespace App\Filament\Widgets;

use App\Models\Transaction;
use Carbon\Carbon;
use Filament\Support\RawJs;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;


class TransactionsChart extends ChartWidget
{
    protected static ?string $heading = 'Transactions per Month';

    protected static ?int $sort = 1;


    protected function getData(): array
    {
        $data = Trend::model(Transaction::class)
            ->between(
                start: now()->startOfYear(),
                end: now()->endOfYear(),
            )->perMonth()
            ->count();

        return [
            'datasets' => [
                [
                    'label' => 'Transactions',
                    'data' => $data->map(fn(TrendValue $value) => $value->aggregate),
                ]
            ],
            'labels' => $data->map(fn(TrendValue $value) => Carbon::parse($value->date)->format('M')),
        ];
    }

    protected function getOptions(): RawJs
    {
        return RawJs::make(<<<JS
        {
            scales: {
                y: {
                    ticks: {
                        precision: 0
                    },
                },
            },
        }
    JS);
    }

    protected function getType(): string
    {
        return 'bar';
    }
}