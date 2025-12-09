<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/beranda', function () {
    return view('customers.dashboard.index');
})->name('beranda');

Route::get('/detail', function () {
    return view('customers.dashboard.detail');
})->name('detail');

Route::get('/', function () {
    return redirect('/products');
});

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/products', [ProductController::class, 'store'])->name('products.store');
Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
Route::resource('products', ProductController::class);

Route::get('/beranda', [HomeController::class, 'index']);

Route::get('/customer/login', function () {
    return view('customers.login'); // kalau belum ada, buat nanti
})->name('customer.login');

