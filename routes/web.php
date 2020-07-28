<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|


Route::get('/', function () {
    return view('home');
});

Route::get('/contacts', function () {
    return view('contacts');
});
*/
Route::name('cms.')->group(function () {
    Route::prefix('{locale}/admin')->middleware([
        'auth',
        'shareCommonData:admin',
        'localize'
    ])->group(function () {
        Route::get('/', 'Admin\DashboardController')->name('dashboard');
        Route::resources([
            'films' => 'Admin\Films\FilmController',
            'pages' => 'Admin\Pages\PageController',
        ], []);
    });
});



Route::view('/', 'home');
Auth::routes();