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

/**
 * Все клиентские страницы
 */
Route::group([
    'middleware' => [
        'all',
    ],
], function () {
    Route::get('/', [HomeController::class, 'index']);

    /**
     * Страницы закрытые
     */
    Route::group([
        'middleware' => [
            'auth',
        ],
    ], function () {
        Route::get('/home', [HomeController::class, 'home'])->name('home');

        Route::group([
            'middleware' => [
                'can:accessBusinessPanel',
            ],
        ], function () {
            Route::resources(['procedure' => '\App\Http\Controllers\ProcedureController']);
            Route::resources(['record' => '\App\Http\Controllers\RecordController']);

            Route::get('/staff', [\App\Http\Controllers\StaffController::class, 'index']);
            Route::get('/statistic', [\App\Http\Controllers\StatisticController::class, 'index'])
                ->name('statistic.index');
            Route::get('/feedback', [\App\Http\Controllers\FeedbackController::class, 'index']);
            Route::get('/message', [\App\Http\Controllers\MessageController::class, 'index']);

            Route::get('/business', [\App\Http\Controllers\BusinessController::class, 'index'])
                ->name('business.index');
            Route::get('/business/edit/{business}', [\App\Http\Controllers\BusinessController::class, 'edit'])
                ->name('business.edit')
                ->middleware("can:accessMyBusinessPanel,business");
            Route::patch('/business/{business}', [\App\Http\Controllers\BusinessController::class, 'update'])
                ->name('business.update')
                ->middleware("can:accessMyBusinessPanel,business");
            Route::delete('/business/{business}', [\App\Http\Controllers\BusinessController::class, 'destroy'])
                ->name('business.destroy')
                ->middleware("can:accessMyBusinessPanel,business");
        });

        Route::get('/business/create', [\App\Http\Controllers\BusinessController::class, 'create'])
            ->name('business.create');
        Route::post('/business/store', [\App\Http\Controllers\BusinessController::class, 'store'])
            ->name('business.store');
    });
});

/**
 * Админка
 */
Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'middleware' => [
        'can:accessAdminPanel',
    ],
], function () {
    Route::resources([
        'business' => 'Admin\BusinessController',
        'procedure' => 'Admin\ProcedureController',
    ]);
});

Auth::routes();
