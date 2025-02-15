<?php

namespace App\Jobs;

use App\Models\Variable;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class GenerateInvoice implements ShouldQueue
{
    use Queueable;

    public $transaction;
    public $variable;

    /**
     * Create a new job instance.
     */
    public function __construct($transaction)
    {
        $this->transaction = $transaction;
        $this->variable = Variable::all();
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        File::ensureDirectoryExists(storage_path('app/public/invoices'));

        $pdf = Pdf::loadView('invoice.invoice', [
            'transaction' => $this->transaction,
            'name' => $this->variable->where('name', 'name')->first()->value ?? '',
            'email' => $this->variable->where('name', 'email')->first()->value ?? '',
        ]);

        $filename = Str::uuid() . '.pdf';

        $pdf->save(storage_path('app/public/invoices/') . $filename);

        $this->transaction->update([
            'invoice' => $filename
        ]);
    }
}