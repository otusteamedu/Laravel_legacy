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

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);

Route::group([
    'middleware' => [
        'auth'
    ]
], function () {
    Route::get('/home', [HomeController::class, 'home']);

    Route::group([
        'middleware' => [
            'can:accessBusinessPanel'
        ]
    ], function () {
        Route::get('/records', [\App\Http\Controllers\RecordController::class, 'index']);
        Route::get('/staff', [\App\Http\Controllers\StaffController::class, 'index']);
        Route::get('/procedures', [\App\Http\Controllers\ProcedureController::class, 'index']);
        Route::get('/statistic', [\App\Http\Controllers\StatisticController::class, 'index']);
        Route::get('/business', [\App\Http\Controllers\BusinessController::class, 'index']);
        Route::get('/feedback', [\App\Http\Controllers\FeedbackController::class, 'index']);
        Route::get('/message', [\App\Http\Controllers\MessageController::class, 'index']);
    });
});

Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'middleware' => [
        'can:accessAdminPanel'
    ]
], function () {
    Route::resources([
        'business' => 'Admin\BusinessController',
        'procedure' => 'Admin\ProcedureController',
    ]);
});

Auth::routes();
