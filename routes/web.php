<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return redirect('/beranda');
});

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/products', [ProductController::class, 'store'])->name('products.store');
Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
Route::resource('products', ProductController::class);

Route::get('/beranda', [HomeController::class, 'index'])->name('beranda');

// AUTH ROUTES - SESUAI DENGAN AuthController
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'postLogin'])->name('login.post');

Route::get('/register', [AuthController::class, 'registration'])->name('register');
Route::post('/register', [AuthController::class, 'postRegistration'])->name('register.post');

// Dashboard admin
Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('admin.dashboard');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Reset Password
Route::get('/reset-password', [AuthController::class, 'resetPassword'])->name('reset.password');
Route::post('/reset-password', [AuthController::class, 'updatePassword'])->name('password.update');

// Customer login (jika ada view terpisah)
Route::get('/customer/login', function () {
    return view('customers.login');
})->name('customer.login');