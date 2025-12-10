<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Customer\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

// Redirect root ke dashboard pembeli
Route::get('/', function () {
    return redirect('/dashboardpembeli');
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