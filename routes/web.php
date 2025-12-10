<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController; // PASTIKAN INI

// ===== RUTE PUBLIK =====
Route::get('/', function () {
    return redirect('/beranda');
});

Route::get('/beranda', [HomeController::class, 'index'])->name('beranda');

// Detail produk bisa diakses publik
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

// ===== AUTH (Hanya untuk guest) =====
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'postLogin'])->name('login.post');
    
    Route::get('/register', [AuthController::class, 'registration'])->name('register');
    Route::post('/register', [AuthController::class, 'postRegistration'])->name('register.post');
    
    // Reset Password
    Route::get('/reset-password', [AuthController::class, 'resetPassword'])->name('reset.password');
    Route::post('/reset-password', [AuthController::class, 'updatePassword'])->name('password.update');
});

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ===== ROUTES UNTUK ADMIN =====
Route::middleware('auth')->group(function () {
    // Dashboard Admin - Hanya untuk role 'admin'
    Route::get('/dashboard', function () {
        if (auth()->user()->role !== 'admin') {
            return redirect()->route('user.dashboard')
                ->with('error', 'Hanya admin yang bisa mengakses dashboard admin');
        }
        return view('dashboard');
    })->name('admin.dashboard');
    
    // Products CRUD - Hanya untuk admin
    Route::prefix('admin')->group(function () {
        Route::get('/products', [ProductController::class, 'index'])->name('products.index');
        Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
        Route::post('/products', [ProductController::class, 'store'])->name('products.store');
        Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
        Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
        Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
    });
});

// ===== ROUTES UNTUK USER/PEMBELI =====
Route::middleware('auth')->group(function () {
    // Dashboard Pembeli - Hanya untuk role 'user'
   Route::get('/pembeli/dashboard', function () {
    if (auth()->user()->role !== 'user') {
        return redirect()->route('admin.dashboard')
            ->with('error', 'Hanya pembeli yang bisa mengakses halaman ini');
    }
    $products = \App\Models\Product::all();
    return view('customers.dashboard.pembeli', compact('products'));
})->name('user.dashboard');

});