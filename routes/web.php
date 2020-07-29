<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\Telegram\TelegramController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Telegram\Bot\Laravel\Facades\Telegram;
use Vrnvgasu\Localization\Middleware\Localization;

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
Route::group(array(
    'middleware' => Localization::ALIAS,
), function() {
    /**
     * Регистрации нет
     */
    Auth::routes(['register' => false]);

    Route::get('/', [SiteController::class, 'index'])->name('main');

    Route::group([
        'prefix' => 'dashboard',
        'middleware' => 'scheduler',
    ], function () {
        Route::get('/', [HomeController::class, 'index'])->name('dashboard');

        Route::resources([
            '/groups' => 'Groups\GroupController',
            '/students' => 'Students\StudentController',
            '/teachers' => 'Teachers\TeacherController',
            '/posts' => 'Posts\PostController',
        ]);

        Route::get('/{post}/send', 'Posts\PostController@send')->name('posts.send');
    });

    Route::group([
        'prefix' => 'admin',
        'middleware' => ['auth', 'admin'],
        'as' => 'admin.',
    ], function () {

        Route::group([
            'namespace' => 'Admin\Telegram',
            'prefix' => 'telegram',
            'as' => 'telegram.',
        ], function () {
            Route::get('/', 'TelegramController@index')->name('index');
            Route::get('/setwebhook', 'TelegramController@setWebhook')->name('setwebhook');
            Route::get('/getwebhookinfo', 'TelegramController@getWebhookInfo')->name('getwebhookinfo');
        });

        Route::group([
            'namespace' => 'Admin\Settings',
            'prefix' => 'settings',
            'as' => 'settings.',
        ], function () {
            Route::post('/', 'SettingController@store')->name('store');
        });
    });
});

Route::post(Telegram::getAccessToken(), [TelegramController::class, 'webhook']);
