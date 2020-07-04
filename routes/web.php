<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Auth;
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
/**
 * Регистрации нет
 */
Auth::routes(['register' => false]);

Route::get('/', [SiteController::class, 'index'])->name('main');

Route::group([
    'prefix' => 'dashboard',
    'middleware' => ['auth', 'forbid_students'],
], function () {
    Route::get('/', [HomeController::class, 'index'])->name('dashboard');

    Route::resources([
        '/groups' => 'Groups\GroupController',
        '/students' => 'Students\StudentController',
        '/teachers' => 'Teachers\TeacherController',
    ]);
});
