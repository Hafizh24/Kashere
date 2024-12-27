<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\TransactionResource;
use App\Models\Transaction;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\Str;

class LatestTransactions extends BaseWidget
{
    protected static ?int $sort = 4;

    protected string | int | array $columnSpan = 'full';

    protected static ?string $heading = 'Latest Transactions';

    public function table(Table $table): Table
    {
        return $table
            ->query(TransactionResource::getEloquentQuery())
            ->defaultPaginationPageOption(5)
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('customer.name')
                    ->sortable()
                    ->searchable()
                    ->formatStateUsing(fn($state) => Str::headline($state)),

                TextColumn::make('grand_total')
                    ->label('Total Price')
                    ->money('IDR'),

                TextColumn::make('created_at')
                    ->label('Transaction Date')
                    ->date()
                    ->sinceTooltip()
                    ->sortable()
            ])
            ->actions([
                Action::make('view transaction')
                    ->url(fn(Transaction $record) => TransactionResource::getUrl('view', ['record' => $record]))
                    ->icon('heroicon-o-eye')
            ]);
    }
}