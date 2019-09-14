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
});

Route::get('/user', function () {
    return redirect('user/register');
});

Route::get('/user/register', function () {
    return view('web.pages.user.register');
});

Route::get('/dashboard', function () {
    return view('web.pages.dashboard.index');
});

Route::get('/content', function () {
    return view('web.pages.content.index');
});

Route::prefix('backend')
    ->namespace('Backend')
    ->group(function () {
        Route::resources([
            'location' => 'LocationController'
        ]);
    });
