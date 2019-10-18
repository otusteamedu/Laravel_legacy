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
        Route::post('users/store', 'UserController@store')->name('users.store');
        Route::get('users/show/{id}', 'UserController@show')->name('users.show');
        Route::patch('users/update/first_name/{id}', 'UserController@editFirstName')->name('users.editFirstName');
        Route::patch('users/update/last_name/{id}', 'UserController@editLastName')->name('users.editLastName');
        Route::patch('users/update/birthday/{id}', 'UserController@editBirthday')->name('users.editBirthday');
        Route::patch('users/update/role/{id}', 'UserController@editRole')->name('users.editRole');
        Route::patch('users/active', 'UserController@active')->name('users.active');
        Route::patch('users/unactive', 'UserController@unactive')->name('users.unactive');
        Route::delete('users/delete', 'UserController@destroy')->name('users.destroy');

});
