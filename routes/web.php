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
    return view('portal.index');
});
Route::get('/about', function () {
    return view('portal.pages.page');
});
Route::get('/auth', function () {
    return view('portal.pages.auth');
});
Route::get('/register', function () {
    return view('portal.pages.register');
});
Route::get('/user', function () {
    return view('portal.user.index');
});
Route::get('/user/edit', function () {
    return view('portal.user.edit');
});
Route::get('/user/changepassword', function () {
    return view('portal.user.change_password');
});