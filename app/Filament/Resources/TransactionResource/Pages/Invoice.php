<?php

namespace App\Filament\Resources\TransactionResource\Pages;

use App\Filament\Resources\TransactionResource;
use App\Models\Transaction;
use Filament\Resources\Pages\Page;

class Invoice extends Page
{
    protected static string $resource = TransactionResource::class;

    public $record;
    public $transaction;

    public function mount($record)
    {
        $this->record = $record;
        $this->transaction = Transaction::find($record);
    }

    protected static string $view = 'filament.resources.transaction-resource.pages.invoice';
}