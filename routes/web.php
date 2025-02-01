<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/admin/login');
});

Route::get('/mailable', function () {
    $transaction = App\Models\Transaction::first();

    return new App\Mail\SendInvoice($transaction);
});