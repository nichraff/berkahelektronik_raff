<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController; // <-- Pastikan ProductController sudah ada!

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('products', ProductController::class); // <-- Baris ini akan bekerja setelah controller dibuat