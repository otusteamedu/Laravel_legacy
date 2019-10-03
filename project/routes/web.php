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

Route::name('public.')->group(function(){
    Route::get('/', function (){
        return view('public.home');
    })->name('home');

    Route::name('account.')->group(function(){
        Route::get('/personal_data', function (){
            return view('public.account.personal_data');
        })->name('personal_data');

        Route::get('/favorites', function (){
            return view('public.account.favorites');
        })->name('favorites');
    });
});

Auth::routes();
