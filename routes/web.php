<?php

use Illuminate\Support\Facades\Route;

Route::get('/', App\Livewire\HomePage::class)->name('home');
Route::get('/categories', App\Livewire\CategoriesPage::class)->name('categories');
Route::get('/products', App\Livewire\ProductsPage::class)->name('products');
Route::get('/products/{product}', App\Livewire\ProductDetailPage::class)->name('product-detail');
Route::get('/cart', App\Livewire\CartPage::class)->name('cart');


Route::middleware('guest')->group(function () {
    Route::get('/login', App\Livewire\Auth\Login::class)->name('login');
    Route::get('/register', App\Livewire\Auth\Register::class)->name('register');
    Route::get('/forgot', App\Livewire\Auth\ForgotPage::class)->name('password.request');
    Route::get('/reset/{token}', App\Livewire\Auth\ResetPassword::class)->name('password.reset');
});

Route::middleware('auth')->group(function () {
    Route::get('/logout', function () {
        auth()->logout();
        return redirect()->route('home');
    })->name('logout');
    Route::get('/checkout', App\Livewire\CheckoutPage::class)->name('checkout');
    Route::get('/my-order', App\Livewire\MyOrderPage::class)->name('my-order');
    Route::get('/my-order/{order_id}', App\Livewire\MyOrderDetailPage::class)->name('my-order-detail');

    Route::get('/success', App\Livewire\SuccessPage::class)->name('success');
    Route::get('/cancel', App\Livewire\CancelPage::class)->name('cancel');
});
