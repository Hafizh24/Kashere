<?php

namespace App\Jobs;

use App\Models\Transaction;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class GenerateInvoice implements ShouldQueue
{
    use Queueable;

    public $transaction;

    /**
     * Create a new job instance.
     */
    public function __construct($transaction)
    {
        $this->transaction = $transaction;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        File::ensureDirectoryExists(storage_path('app/public/invoices'));

        $pdf = Pdf::loadView('invoice.invoice', ['transaction' => $this->transaction]);

        $filename = Str::uuid() . '.pdf';

        $pdf->save(storage_path('app/public/invoices/') . $filename);

        $this->transaction->update([
            'invoice' => $filename
        ]);
    }
}