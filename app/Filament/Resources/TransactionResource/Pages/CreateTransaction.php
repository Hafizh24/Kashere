<?php

namespace App\Filament\Resources\TransactionResource\Pages;

use App\Filament\Resources\TransactionResource;
use App\Jobs\GenerateInvoice;
use App\Models\Product;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTransaction extends CreateRecord
{
    protected static string $resource = TransactionResource::class;

    // protected function beforeCreate(): void
    // {
    //     GenerateInvoice::dispatch($this->record);
    // }


    protected function afterCreate(): void
    {
        $transaction = $this->record;

        foreach ($transaction->transactionProducts as $item) {
            $product = Product::find($item->product_id);
            if ($product) {
                if ($product->total_stock >= $item->quantity) {
                    $product->decrement('total_stock', $item->quantity);
                } else {
                    throw new \Exception("Not enough stock for product: {$product->name}");
                }
            }
        }

        // GenerateInvoice::dispatch($transaction);
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}