<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/admin/login');
});

Route::get('/mailable', function () {
    $transaction = App\Models\Transaction::find(1);

    return new App\Mail\SendInvoice($transaction);
});