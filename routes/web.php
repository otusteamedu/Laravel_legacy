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
    return view('index');
});

Route::get('/about/', function () {
    return view('about.index');
});

Route::get('/news/', function () {
    return view('news.index');
});

Route::get('/auth/', function () {
    return view('auth.index');
});

Route::get('/registration/', function () {
    return view('register.index');
});

Route::get('/personal/', function () {
    return view('personal.index');
});

Route::get('admin', function () {
    return view('admin.index');
})->name('admin.index');


Route::name('admin.')->group(function () {
    Route::prefix('admin')->group(function () {
        Route::resource('articles', 'Web\Admin\ArticleController');
        Route::resource('countries', 'Web\Admin\CountryController');
        Route::resource('events', 'Web\Admin\EventController');
        Route::resource('languages', 'Web\Admin\LanguageController');
        Route::resource('news', 'Web\Admin\NewsController');
        Route::resource('roles', 'Web\Admin\RoleController');
        Route::resource('users', 'Web\Admin\UserController');
    });
});
