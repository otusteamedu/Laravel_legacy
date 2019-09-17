<?php
$adminUrl = config('app.admin_url');

Route::get('/', function (){
    return view('page.home');
})->name('home');

Route::get('/contact', function (){
    return view('page.contact');
})->name('contact');

Route::get('/login', function(){
    return view('auth.login');
})->name('login');

Route::get('/register', function(){
    return view('auth.register');
})->name('register');

Route::get('/cabinet/profile', function(){
    return view('cabinet.profile.index');
})->name('cabinet.profile');

Route::group(
    [
        'prefix' => $adminUrl,
        'namespace' => 'Admin',
        'as' => 'admin.',
    ],
    function (){
        Route::get('users', 'UserController@index')->name('users.index');
});
