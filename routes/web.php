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

/*Route::get('/', function () {
    return view('welcome');
});

Route::get('/index', function () {
    return view('pages/index');
});

Route::get('/login', function () {
    return view('pages/login');
});

Route::get('/register', function () {
    return view('pages/register');
});

Route::get('/home', function () {
    return view('pages/home');
});*/

//Route::get('/home','UsersController@show');

Route::get('/katalog', function () {
    return view('pages/katalog');
});

Route::name('cms.')->group(function () {
    Route::prefix('')->group(function () {
        Route::resources([
            'users' => 'CMS\Users\UsersController',
        ], [
            'except' => [
            ],
        ]);
    });
});
//Route::resource('users','CMS\Users\UsersController');

/*Route::get('/admin/index','UsersController@index');
Route::get('/admin/users/{id}','UsersController@show');*/

