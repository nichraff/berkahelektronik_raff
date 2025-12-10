<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\StripeController;

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
// cart
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{productId}', [CartController::class, 'add'])->name('cart.add');
Route::put('/cart/{cart}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/{cart}', [CartController::class, 'delete'])->name('cart.delete');
// transaksi
Route::post('/checkout', [TransactionController::class, 'checkout'])->name('checkout');
Route::get('/transactions/{transaction}', [TransactionController::class, 'show'])->name('transactions.show');

Route::get('/checkout', [StripeController::class, 'start'])->name('checkout.start');
Route::get('/checkout/success', [StripeController::class, 'success'])->name('checkout.success');
Route::get('/checkout/cancel', [StripeController::class, 'cancel'])->name('checkout.cancel');

// RIWAYAT TRANSAKSI
Route::get('/transactions/history', [TransactionController::class, 'history'])
    ->name('transactions.history')
    ->middleware('auth');
