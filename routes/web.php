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

    return view('public.index.page');
});

Route::get('/contact', function () {
    return view('public.contacts.page');
});

Route::get('/delivery', function () {
    return view('public.delivery.page');
});

Route::name('admin.')->group(function(){
    Route::prefix('admin')->group(function(){
        Route::resources([
            'news'=>'Admin\News\NewsController',
            'category'=>'Admin\Category\CategoryController'
        ]);
    });
}); 

/* Route::get('/admin/news', function () {
    return view('admin.news.page');
}); */
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
