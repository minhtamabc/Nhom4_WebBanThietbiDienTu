<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminController;


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

        Route::post('/update/{idProduct}/{idDonHang}', [CartController::class, 'update'])->name('cart.update');
        Route::get('/remove/{idProduct}/{idDonHang}', [CartController::class, 'remove'])->name('cart.remove');
        Route::get('/clear/{id}', [CartController::class, 'clear'])->name('cart.clear');

        // xử lý đơn hàng
        Route::get('/my-order',[OrderController::class,'index'])->name('order.index');
        Route::post('/',[OrderController::class,'order'])->name('order.order');
        Route::get('/my-history',[OrderController::class,'myHistory'])->name('order.history');
        Route::get('/my-history/order/{idDonHang}',[OrderController::class,'detailOneOfHistory'])->name('order.history-detail');
        Route::post('/my-history/order',[OrderController::class,'huyDon'])->name('order.huy');
        Route::put('/my-history/order',[OrderController::class,'daNhanDuocHang'])->name('order.confirm');
    });
});

// chi tiet san pham
Route::get('/product/{idProduct}',[ProductController::class,'productDetail'])->name('product.detail');

//admin
Route::get('/trang-chu/login',[AdminController::class, 'login'])->name('admin.login');
Route::post('/trang-chu/login',[AdminController::class, 'handleLogin'])->name('admin.handleLogin');
Route::middleware(['admin.check'])->group(function () {
    Route::prefix('trang-chu')->group(function () {
        Route::get('/',[AdminController::class,'index'])->name('admin.home');
        Route::get('/logout',[AdminController::class, 'logout'])->name('admin.logout');

        //quản lý sản phẩm
        Route::get('/product-management',[AdminController::class, 'productManagement'])->name('admin.product');

        //quản lý đơn hàng
        Route::get('/order-management/{trangThai?}',[AdminController::class, 'orderManagement'])->name('admin.order');
        Route::get('/order-management/detail/{idDonHang?}',[AdminController::class, 'detail'])->name('admin.detail');

        Route::post('/order-management',[AdminController::class, 'orderConfirm'])->name('admin.confirm');
        Route::put('/order-management',[AdminController::class, 'confirmStep2'])->name('admin.confirmStep2');

        Route::post('/order-management/2',[AdminController::class, 'detailOrder'])->name('admin.detail-order');
        Route::put('/order-management/2',[AdminController::class, 'delivery'])->name('admin.confirm-delivery');

        Route::post('/order-management/3',[AdminController::class, 'confirmFinish'])->name('admin.finish-order');
    });
});

//vnpay return 
Route::get('/vnpay-return',[OrderController::class,'vnpayReturn'])->name('order.vnpay');
