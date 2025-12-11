<?php

use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\StripeController;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/

// Root → beranda
Route::get('/', fn() => redirect()->route('beranda'));
Route::get('/beranda', [HomeController::class, 'index'])->name('beranda');

// Detail produk bisa diakses publik
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

/*
|--------------------------------------------------------------------------
| AUTH (GUEST)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'postLogin'])->name('login.post');

    Route::get('/register', [AuthController::class, 'registration'])->name('register');
    Route::post('/register', [AuthController::class, 'postRegistration'])->name('register.post');

    Route::get('/reset-password', [AuthController::class, 'resetPassword'])->name('reset.password');
    Route::post('/reset-password', [AuthController::class, 'updatePassword'])->name('password.update');
});

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| USER ROUTES (PEMBELI)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    // Dashboard pembeli
    Route::get('/pembeli/dashboard', function () {
        if (auth()->user()->role !== 'user') {
            return redirect()->route('admin.dashboard')
                ->with('error', 'Hanya pembeli yang bisa mengakses halaman ini');
        }
        $products = \App\Models\Product::all();
        return view('customers.dashboard.pembeli', compact('products'));
    })->name('user.dashboard'); // nama route user.dashboard

    // Cart
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{productId}', [CartController::class, 'add'])->name('cart.add');
    Route::put('/cart/{cart}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{cart}', [CartController::class, 'delete'])->name('cart.delete');

    // Transaksi
    Route::post('/checkout', [TransactionController::class, 'checkout'])->name('checkout');
    Route::get('/transactions/{transaction}', [TransactionController::class, 'show'])->name('transactions.show');
    Route::get('/transactions/history', [TransactionController::class, 'history'])->name('transactions.history');

    // Stripe checkout
    Route::prefix('checkout')->group(function () {
        Route::get('/start', [StripeController::class, 'start'])->name('checkout.start');
        Route::get('/success', [StripeController::class, 'success'])->name('checkout.success');
        Route::get('/cancel', [StripeController::class, 'cancel'])->name('checkout.cancel');
    });
});

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->prefix('admin')->group(function () {

    // Dashboard admin
    Route::get('/dashboard', function () {
        if (auth()->user()->role !== 'admin') {
            return redirect()->route('user.dashboard')
                ->with('error', 'Hanya admin yang bisa mengakses dashboard admin');
        }
        return view('dashboard');
    })->name('admin.dashboard');

    // CRUD Produk
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
});

// Laporan Penjualan (Admin)
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/laporan', [\App\Http\Controllers\Admin\ReportController::class, 'index'])
        ->name('admin.report');
});

// Invoice Sederhana (Admin)
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/invoice/{transaction}', [\App\Http\Controllers\Admin\InvoiceController::class, 'show'])
        ->name('admin.invoice.show');
});