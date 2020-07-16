<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
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
        ]);
    });
});
