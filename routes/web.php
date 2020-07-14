<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Locales\LocaleController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;

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

Route::get('/locales/change/{locale}', [LocaleController::class, 'change'])->name('locales.change');

Route::group([
    'middleware' => 'localization',
], function() {
    /**
     * Регистрации нет
     */
    Auth::routes(['register' => false]);

    Route::get('/', function () {
        dump(Cache::put('test', 123123));
        dump(Cache::get('test'));
        Cache::flush();
        dump(Cache::get('test'));
        //dd(Cache::getStore());
    })->name('main');

    Route::group([
        'prefix' => 'dashboard',
        'middleware' => 'scheduler',
    ], function () {
        Route::get('/', [HomeController::class, 'index'])->name('dashboard');

        Route::resources([
            '/groups' => 'Groups\GroupController',
            '/students' => 'Students\StudentController',
            '/teachers' => 'Teachers\TeacherController',
        ]);
    });
});
