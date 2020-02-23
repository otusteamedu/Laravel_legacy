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
Route::name('cms.')->prefix('cms')->middleware('cms.menu')->group(function () {
    Route::get('', 'Cms\IndexController')->name('index');

    Route::resources([
        'pages' => 'Cms\Page\PagesController',
    ]);

    Route::resource('comments', 'Cms\Post\Comment\CommentsController')
        ->except([
            'edit',
            'create',
            'store',
        ]);

    Route::resources([
        'posts' => 'Cms\Post\Post\PostsController',
        'rubrics' => 'Cms\Post\Rubric\RubricsController',
    ]);
    Route::put('posts/{post}/published', 'Cms\Post\Post\PostsController@published')
        ->name('posts.published');

    Route::resources([
        'groups' => 'Cms\User\Group\GroupsController',
        'users' => 'Cms\User\User\UsersController',
    ]);

    Route::resource('rights', 'Cms\User\Right\RightsController')
        ->only('index');

    Route::resources([
        'settings' => 'Cms\Setting\SettingsController',
]   );
});