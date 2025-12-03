<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;

Route::get('/beranda', function () {
    return view('customers.dashboard.index');
})->name('beranda');

Route::get('/detail', function () {
    return view('customers.dashboard.detail');
})->name('detail');

Route::resource('products', ProductController::class);
