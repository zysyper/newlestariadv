<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MyOrderController;
use Illuminate\Support\Facades\Route;


Route::get('/products', function () {
    return view('pages.produk');
})->name('produk');
Route::get('/products/{slug}', function ($slug) {
    return view('pages.product-detail', compact('slug'));
})->name('produk.detail');
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/categories', [HomeController::class, 'kategori'])->name('kategori');

// Products by category route
Route::get('/products?categories[0]={kategori_id}', function() {
    return view('pages.produk');
})->name('kategori.produk');

Route::middleware('guest')->group(function () {
    // Login
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    // Register
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    // Forgot Password
    Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('password.request');
    Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');

    // Reset Password
    Route::get('/reset-password/{token}', [AuthController::class, 'showResetPassword'])->name('password.reset');
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');
});



Route::middleware('auth')->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('/checkout', [CheckoutController::class, 'placeOrder'])->name('checkout.place');
    Route::get('/checkout/success/{order?}', [CheckoutController::class, 'success'])->name('checkout.success');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/myorder', [MyOrderController::class, 'index'])->name('my-orders');
    Route::get('/myorder/{order}', [MyOrderController::class, 'show'])->name('orders.show');
    Route::post('/payment/{order}', [MyOrderController::class, 'payment'])->name('orders.payment');
    Route::patch('/myorder/{order}/cancel', [MyOrderController::class, 'cancel'])->name('orders.cancel');
    Route::get('/cart', function () {
    return view('pages.cart');
    });


});


// Add this route to your web.php file


