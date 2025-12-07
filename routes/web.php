<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\ProductController;

// Trang chủ
Route::get('/', [ProductController::class,'products'])->name('home');

// Authentication routes
Route::get('/login', function () {
    // Nếu đã đăng nhập thì redirect về trang chủ
    if (session('user_id')) {
        return redirect()->route('home');
    }
    return view('login');
})->name('login');

Route::get('/auth/google', [GoogleAuthController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [GoogleAuthController::class, 'handleGoogleCallback'])->name('google.callback');
Route::get('/logout', [GoogleAuthController::class, 'logout'])->name('logout');


// Cart routes - CẦN đăng nhập
Route::middleware(['check.login'])->group(function () {
    Route::prefix('cart')->group(function () {
        Route::get('/', [CartController::class, 'index'])->name('cart.index');

        Route::post('/add', [CartController::class, 'add'])->name('cart.add');
        Route::post('/buyNow', [CartController::class, 'buyNow'])->name('cart.buyNow');

        Route::post('/update/{idProduct}/{idDonHang}', [CartController::class, 'update'])->name('cart.update');
        Route::get('/remove/{idProduct}/{idDonHang}', [CartController::class, 'remove'])->name('cart.remove');
        Route::get('/clear/{id}', [CartController::class, 'clear'])->name('cart.clear');
    });
});

// chi tiet san pham
Route::get('/product/{idProduct}',[ProductController::class,'productDetail'])->name('product.detail');