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

Route::name('portal.')
    ->middleware([
        'page.menu',
        'rubric.menu',
    ])
    ->group(function () {
        Route::get(
            '',
            'Portal\IndexController@show'
        )->name('home');

        Route::get(
            'content/{slug}',
            'Portal\Page\PageController@show'
        )->name('page');

        Route::name('post.')
            ->prefix('post')
            ->group(function () {
                Route::get(
                    '',
                    'Portal\Post\PostController@index'
                )->name('list');

                Route::get(
                    'view/{slug}',
                    'Portal\Post\PostController@show'
                )->name('view');

                Route::get(
                    '{rubric}',
                    'Portal\Post\PostController@rubricList'
                )->name('rubric.list');
            });

        Route::name('user.')
            ->prefix('user')
            ->middleware([
                'auth',
                'user.menu',
            ])
            ->group(function () {
                Route::get(
                    '',
                    'Portal\User\UserController@show'
                )->name('profile');

                Route::get(
                    'edit',
                    'Portal\User\UserController@edit'
                )->name('edit');

                Route::put(
                    'edit',
                    'Portal\User\UserController@update'
                )->name('update');

                Route::get(
                    'changepassword',
                    'Portal\User\UserController@changePassword'
                )->name('change.password');

                Route::put(
                    'changepassword',
                    'Portal\User\UserController@updatePassword'
                )->name('update.password');
            });
    });

Route::name('authentication.')
    ->group(function() {
        Route::get('login', 'Auth\LoginController@showLoginForm')
            ->name('pages.login');

        Route::post('login', 'Auth\LoginController@login')
            ->name('login');

        Route::get('logout', 'Auth\LoginController@logout')
            ->middleware('auth')
            ->name('logout');

        Route::get('register', 'Auth\RegisterController@showRegistrationForm')
            ->name('register');
    });

Route::name('cms.')
    ->prefix('{locale}/cms')
    ->middleware([
        'auth',
        'locale',
        'share.data',
        'cms.menu',
    ])
    ->group(function () {
        Route::get('', 'Cms\IndexController')
            ->name('index');

        Route::resources([
            'pages' => 'Cms\Page\PagesController',
        ]);

        Route::resource(
            'comments',
            'Cms\Post\Comment\CommentsController'
            )->except([
                'edit',
                'create',
                'store',
            ]);

        Route::resources([
            'posts' => 'Cms\Post\Post\PostsController',
            'rubrics' => 'Cms\Post\Rubric\RubricsController',
        ]);

        Route::put(
            'posts/{post}/published',
            'Cms\Post\Post\PostsController@published'
            )->name('posts.published');

        Route::resources([
            'groups' => 'Cms\User\Group\GroupsController',
            'users' => 'Cms\User\User\UsersController',
        ]);

        Route::resource(
            'rights',
            'Cms\User\Right\RightsController'
            )->only('index');

        Route::resources([
            'settings' => 'Cms\Setting\SettingsController',
        ]);
    });
