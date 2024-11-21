<?php

use App\Livewire\Home;
use Illuminate\Support\Facades\Route;


// Route::get('/home', function () {
//     return view('home');
// });

Route::get('/home', Home::class)->name('home');