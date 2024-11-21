<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransactionResource\Pages;
use App\Filament\Resources\TransactionResource\RelationManagers;
use App\Models\Product;
use App\Models\Transaction;
use Filament\Forms;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TransactionResource extends Resource
{
    protected static ?string $model = Transaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-credit-card';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Order Items')->schema([
                    Repeater::make('transactionProducts')
                        ->label('Items')
                        ->relationship()
                        ->schema([
                            Select::make('product_id')
                                ->relationship('product', 'name')
                                ->searchable()
                                ->preload()
                                ->columnSpan(4)
                                ->reactive()
                                ->afterStateUpdated(function (Set $set, $state) {
                                    $set('unit_amount', Product::find($state)?->price ?? 0);
                                })
                                ->required(),

                            TextInput::make('quantity')
                                ->numeric()
                                ->default(0)
                                ->columnSpan(2)
                                ->reactive()
                                ->required()
                                ->afterStateUpdated(function (Set $set, Get $get, $state) {
                                    $set('total_amount', $state * $get('unit_amount'));
                                }),

                            TextInput::make('unit_amount')
                                ->numeric()
                                ->disabled()
                                ->columnSpan(3)
                                ->required(),

                            TextInput::make('total_amount')
                                ->numeric()
                                ->columnSpan(3)
                                ->required(),
                        ])->columns(12)
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTransactions::route('/'),
            'create' => Pages\CreateTransaction::route('/create'),
            'edit' => Pages\EditTransaction::route('/{record}/edit'),
        ];
    }
}
