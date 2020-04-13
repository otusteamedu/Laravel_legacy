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



Route::name('index')->get('/', function () {
    return view('public.index.page');
});

Route::get('/contact', function () {
    return view('public.contacts.page');
});

Route::get('/delivery', function () {
    return view('public.delivery.page');
});

Route::get('/admin', 'Auth\LoginRedirectController');

Route::name('admin.')->group(function(){
    Route::prefix('admin')->middleware([
            'auth',
            'check_user'
        ])->group(function(){
        Route::resources([
            'index'=>'Admin\Index\IndexController',
            'user'=>'Admin\Users\UsersController',
            'news'=>'Admin\News\NewsController',
            'category'=>'Admin\Category\CategoryController'
        ]);
    });
}); 

Auth::routes();

