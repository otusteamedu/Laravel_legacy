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

Auth::routes();

Route::get('/', function () {
    return view('index');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/test', function () {
    phpinfo();
    return ['message' => 'ok'];
})->name('test');

Route::resource('profile', 'Users\UserController')
    ->middleware('auth')
    ->only(
        ['index', 'update']
    );

Route::resource('wishlists', 'Wishlists\WishlistController')
    ->middleware('auth')
    ->except(
        ['create', 'edit', 'update']
    );

Route::resource('product', 'Products\ProductController')
    ->middleware('auth')
    ->only(
        ['store', 'show']
    );

Route::resource('wishlist-products', 'WishlistProduct\WishlistProductController')
    ->middleware('auth')
    ->only(
        ['destroy']
    );