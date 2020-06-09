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
*/

Route::get('/', function () {
    return view('home');
});

Route::get('/contacts', function () {
    return view('contacts');
});

Route::get('/register', function () {
    return view('register');
});

Route::get('/admin', function () {
    return view('admin/home');
});


Route::get('/admin/pages', 'Admin\PageController@index')->name('pages');

Route::get('/admin/pages/edit/{id}', 'Admin\PageController@edit')->name('pages.edit');


Route::get('/admin/films/edit/{id}', 'Admin\FilmController@edit')->name('films.edit');

Route::get('/admin/films', 'Admin\FilmController@index')->name('films');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', function() {
    return view('home');
})->name('home')->middleware('auth');
