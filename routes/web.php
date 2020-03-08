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
    ->group(function () {
        Route::get(
            '',
            function () {
                return view('portal.index');
            }
        )->name('home');

        Route::get(
            'about',
            function () {
                return view('portal.pages.page');
            }
        )->name('about');


        Route::get('login', 'Auth\LoginController@showLoginForm')
            ->name('pages.login');

        Route::post('login', 'Auth\LoginController@login')
            ->name('login');

        Route::get('logout', 'Auth\LoginController@logout')
            ->middleware('auth')
            ->name('logout');

        Route::get('register', 'Auth\RegisterController@showRegistrationForm')
            ->name('register');

        Route::name('user.')
            ->prefix('user')
            ->middleware('auth')
            ->group(function () {
                Route::get(
                    '',
                    function () {
                        return view('portal.user.index');
                    }
                )->name('home');

                Route::get(
                    'edit',
                    function () {
                        return view('portal.user.edit');
                    }
                )->name('edit');

                Route::get(
                    'changepassword',
                    function () {
                        return view('portal.user.change_password');
                    }
                )->name('changepassword');
            });
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
        ]);
    });
