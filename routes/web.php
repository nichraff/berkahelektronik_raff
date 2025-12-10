<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', [AuthController::class, 'index'])->name('login');

Route::resource('products', ProductController::class);

Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post'); 
Route::get('registration', [AuthController::class, 'registration'])->name('register');
Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register.post'); 
Route::get('/admin/dashboard', [AuthController::class, 'dashboard'])->name('admin.dashboard');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/reset-password', [AuthController::class, 'resetPassword'])->name('reset.password');
Route::post('/reset-password', [AuthController::class, 'updatePassword'])->name('reset.password.post');
Route::get('/login', [AuthController::class, 'index'])->name('login');

// ==================== TAMBAHKAN ROUTE MIDDLEWARE DI SINI ====================

// Route khusus admin (middleware: auth + admin)
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard', [
            'user' => auth()->user()
        ]);
    })->name('admin.dashboard');
    
    Route::get('/test-admin', function () {
        return view('test', [
            'message' => 'Halaman Admin - Middleware Admin berfungsi!',
            'user' => auth()->user()
        ]);
    })->name('test.admin');
});

// Route khusus pembeli (middleware: auth + pembeli)
Route::middleware(['auth', 'pembeli'])->group(function () {
    Route::get('/user/dashboard', function () {
        return view('user.dashboard', [
            'user' => auth()->user()
        ]);
    })->name('user.dashboard');
    
    Route::get('/test-pembeli', function () {
        return view('test', [
            'message' => 'Halaman Pembeli - Middleware Pembeli berfungsi!',
            'user' => auth()->user()
        ]);
    })->name('test.pembeli');
});

// Dashboard umum (redirect berdasarkan role)
Route::get('/dashboard', function () {
    if (auth()->check()) {
        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('user.dashboard');
        }
    }
    return redirect()->route('login');
})->name('dashboard');

Route::post('/check-account', [ProductController::class, 'checkAccount'])->name('check.account');
