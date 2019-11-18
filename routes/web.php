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

Route::get('/', function () {
    return view('web.pages.index');
})->name('web');

Route::get('/dashboard', function () {
    return view('web.pages.dashboard.index');
})->name('web.dashboard');

Route::get('/content', function () {
    return view('web.pages.content.index');
})->name('web.content');

Route::get('/backend', function () {
    return view('backend.pages.index');
})->name('backend');

Route::prefix('backend')
    ->namespace('Backend')
    ->name('backend.')
    ->group(function () {
        Route::resources([
            'location' => 'LocationController',
            'workout' => 'WorkoutController',
        ]);
    });

Auth::routes();
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');
