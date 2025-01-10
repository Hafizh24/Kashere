<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/admin/login');
});

Route::get('/mailable', function () {
    $invoice = App\Models\Transaction::find(4);

    return new App\Mail\SendInvoice($invoice);
});