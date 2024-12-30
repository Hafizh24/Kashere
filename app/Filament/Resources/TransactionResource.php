<?php

namespace App\Filament\Resources;

use App\Filament\Exports\TransactionExporter;
use App\Filament\Resources\TransactionResource\Pages;
use App\Filament\Resources\TransactionResource\RelationManagers;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\Variable;
use Filament\Forms;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\ExportAction;
use Filament\Tables\Actions\ExportBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Number;
use Illuminate\Support\Str;


class TransactionResource extends Resource
{
    protected static ?string $model = Transaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-credit-card';

    // protected static ?int $navigationSort = 4;



    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()->schema([
                    Section::make('Customer Information')->schema([
                        Select::make('customer_id')
                            ->relationship('customer', 'name')
                            ->options(
                                Customer::all()
                                    ->pluck('name', 'id')
                                    ->map(fn($name) => Str::headline($name))
                            )
                            ->createOptionForm([
                                TextInput::make('name')
                                    ->required()
                                    ->maxLength(255),
                                TextInput::make('contact')
                                    ->maxLength(255)
                                    ->required()
                            ])
                            ->createOptionAction(function (Action $action) {
                                return $action
                                    ->modalHeading('Add New Customer')
                                    ->modalButton('Add Customer');
                            })
                            ->searchable()
                            ->required(),

                        TextInput::make('notes')
                    ])->columns(2),

                    Section::make('Order Items')->schema([
                        Repeater::make('transactionProducts')
                            ->label('')
                            ->relationship()
                            ->schema([
                                Select::make('product_id')
                                    ->relationship('product', 'name')
                                    ->options(fn() => Product::where('is_active', true)
                                        ->where('total_stock', '>', 0)
                                        ->get()->pluck('name', 'id')
                                        ->map(fn($name) => Str::headline($name)))
                                    ->required()
                                    ->searchable()
                                    ->preload()
                                    ->distinct()
                                    ->columnSpan(4)
                                    ->disableOptionsWhenSelectedInSiblingRepeaterItems()
                                    ->live()
                                    ->afterStateUpdated(function (Set $set, $state) {
                                        $set('unit_amount', Product::find($state)?->price ?? 0);
                                    })
                                    ->afterStateUpdated(function (Set $set, $state) {
                                        $set('total_amount', Product::find($state)?->price ?? 0);
                                    }),

                                TextInput::make('quantity')
                                    ->numeric()
                                    ->minValue(1)
                                    ->live()
                                    ->columnSpan(2)
                                    ->required()
                                    ->maxValue(fn(Get $get) => Product::find($get('product_id'))?->total_stock ?? 0)
                                    ->afterStateUpdated(function (Set $set, Get $get, $state) {
                                        $set('total_amount', $state * $get('unit_amount'));
                                    }),

                                TextInput::make('unit_amount')
                                    ->numeric()
                                    ->required()
                                    ->disabled()
                                    ->dehydrated()
                                    ->columnSpan(3),

                                TextInput::make('total_amount')
                                    ->numeric()
                                    ->required()
                                    ->disabled()
                                    ->dehydrated()
                                    ->columnSpan(3),
                            ])->columns(12),

                        Placeholder::make('grand_total_placeholder')
                            ->label('Grand Total (include tax)')
                            ->content(function (Get $get, Set $set) {
                                $total = 0;
                                if (!$repeaters = $get('transactionProducts')) {
                                    return $total;
                                }

                                $tax = 1 + intval(Variable::where('name', 'tax rate')->first()->value) / 100;

                                foreach ($repeaters as $item => $value) {
                                    $total = $get('transactionProducts.' . $item . '.total_amount') * $tax;
                                }

                                $set('grand_total', $total);

                                return Number::currency($total, 'Rp.');
                            }),

                        Hidden::make('grand_total')
                            ->default(0),

                    ])
                ])->columnSpanFull()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
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
            ->filters([
                //
            ])
            ->actions([

                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    ExportBulkAction::make()->exporter(TransactionExporter::class),
                ]),
            ])
            ->headerActions([
                ExportAction::make()->exporter(TransactionExporter::class),
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
            'view' => Pages\ViewTransaction::route('/{record}'),
            'edit' => Pages\EditTransaction::route('/{record}/edit'),
        ];
    }
};
