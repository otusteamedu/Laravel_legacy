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

/*
 * prefix('ku') => URI: ku/users
 * name('cms.') => route name : cms.users.index
 */
Route::prefix('')->group(function () {
    Route::name('cms.')->group(function () {
        // Route::resources(['users' => 'CMS\Users\UsersController', ], [  'except' => [  ],  ]);
        // или тоже самое, в развёнутом виде :
        Route::resources(
            [
                'users' => 'CMS\Users\UsersController',
            ],
            [
                'except' => [],
            ]
        ); // close resources
    });
});

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

Auth::routes();

Route::get('/katalog', 'PagesController@katalog')->name('katalog');

Route::get('/', 'PagesController@index')->name('index');

Route::get('/profile', 'PagesController@profile')->name('profile')->middleware('auth');

// пришлось прописать полный путь, иначе, если прописать только UsersController@updateProfile, то
// выдаёт ошибку \App\Http\Controllers\UsersController.php not found
Route::patch('/profile/{user}', '\App\Http\Controllers\CMS\Users\UsersController@updateProfile')->name('update.profile')->middleware('auth');

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout')->middleware('auth');
