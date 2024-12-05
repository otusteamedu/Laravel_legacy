<?php

Route::get('/', 'HomeController@index')->name('home');

Route::get('/orders', 'OrdersController@index');
Route::get('/orders/create', 'OrdersController@create');
Route::post('/orders', 'OrdersController@store')->name('orders.store');
Route::get('/orders/{order}/edit', 'OrdersController@edit');
Route::patch('/orders/{order}', 'OrdersController@update')->name('orders.update');
Route::get('/orders/{order}', 'OrdersController@show');
Route::delete('/orders/{order}', 'OrdersController@destroy')->name('orders.destroy');


Route::get('/users', 'UsersController@index');
Route::get('/users/{user}/edit', 'UsersController@edit');
Route::patch('/users/{user}', 'UsersController@update')->name('users.update');
Route::get('/users/{user}', 'UsersController@show');
Route::delete('/users/{user}', 'UsersController@destroy')->name('users.destroy');


Route::get('/register', 'RegistrationController@create');
Route::post('/register', 'RegistrationController@store');


Route::get('/login', 'SessionsController@create')->name('login');
Route::post('/login', 'SessionsController@store');
Route::get('/logout', 'SessionsController@destroy');

Route::post('/api/authorize', 'ApiController@authorization');
Route::get('/api/password', 'ApiController@password');
Route::post('/api/register', 'ApiController@register');
Route::get('/api/personal', 'ApiController@personal');
Route::put('/api/personal', 'ApiController@personalUpdate');
Route::get('/api/orders', 'ApiController@orders');
Route::post('/api/orders', 'ApiController@create');
Route::delete('/api/orders/{order}', 'ApiController@delete');