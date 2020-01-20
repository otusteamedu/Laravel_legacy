<?php

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

Route::prefix('{locale?}')->group(function () {
    Route::middleware(['localize'])->group(function () {
        Auth::routes();

        Route::get('/', function () {
            return view('index');
        })->name('index');
    });

    Route::middleware(['auth', 'auth.active', 'localize'])->group(function () {
        Route::resource('wishlists', 'Wishlists\WishlistController')
            ->except(['create', 'edit', 'update']);

        Route::resource('profile', 'Users\UserController')
            ->only(['index', 'update']);

        Route::resource('product', 'Products\ProductController')
            ->only(['store', 'show']);

        Route::resource('wishlist-products', 'WishlistProduct\WishlistProductController')
            ->only(['destroy']);
    });
});


