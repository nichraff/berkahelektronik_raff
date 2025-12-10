<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Customer\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\StripeController;

// Redirect root ke dashboard pembeli
Route::get('/', function () {
    return redirect('/beranda');
});

// Dashboard pembeli - INI HARUS DI ATAS ROUTE RESOURCE
Route::get('/dashboardpembeli', [DashboardController::class, 'index'])->name('dashboardpembeli');

// Route untuk admin/products (jika ini untuk admin)
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
});

// Detail produk untuk customer (harus setelah admin routes)
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

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
// Grup route untuk customer lainnya
Route::prefix('customer')->name('customer.')->group(function () {
    // Login customer
    Route::get('/login', function () {
        return view('customers.login');
    })->name('login');
    
    // Detail produk khusus customer (jika berbeda dengan yang di atas)
    Route::get('/detail/{product}', function ($product) {
        // Logic untuk detail produk customer
        return view('customers.dashboard.detail', ['product' => $product]);
    })->name('detail');
});
