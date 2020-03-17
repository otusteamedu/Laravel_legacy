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

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\Auth\LoginController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('login', [LoginController::class, 'showLoginForm'])
    ->name('pages.login');

Route::post('login', [LoginController::class, 'authenticate'])
    ->name('login');

Route::get('logout', [LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

Route::prefix('clients')
    ->middleware('auth')
    ->group(static function () {
        // Список клиентов
        Route::get('', [ClientController::class, 'list'])
            ->name('master.user.list');

        Route::get('create', [ClientController::class, 'showCreate'])
            ->name('master.user.create');

        // Создание клиента
        Route::post('create', [ClientController::class, 'create'])
            ->name('master.user.create');

        // Детальная страница клиента/список записей клиента
        Route::get('{id}', [ClientController::class, 'detail'])
            ->name('master.user.detail');

        // Редактирование клиента
        Route::get('{id}/edit', [ClientController::class, 'edit'])
            ->name('master.user.edit');

        // Создание записи для клиента
        Route::get('{id}/create_record', [ClientController::class, 'showCreateRecord'])
            ->name('master.user.create_record');

        Route::post('{id}/create_record', [ClientController::class, 'createRecord'])
            ->name('master.user.create_record');
    });

Route::prefix('records')
    ->middleware('auth')
    ->group(static function () {
        // Список записей у мастера (всех)
        Route::get('', [RecordController::class, 'list'])
            ->name('master.record.list');

        // Детальная информация о записи (не знаю что тут показывать)
//    Route::get('{id}', static function () {
//        return view('pages.master.record.detail');
//    })->name('master.record.detail');

        // Редактирование записи
        Route::get('{id}/edit', [RecordController::class, 'showEdit'])
            ->name('master.record.edit');

        Route::post('{id}/edit', [RecordController::class, 'edit'])
            ->name('master.record.edit');
    });
