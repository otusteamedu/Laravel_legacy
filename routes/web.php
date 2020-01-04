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

Route::get('/', function () {
    return view('welcome');
});

Route::get('login', static function () {
    return view('pages.login');
});

Route::prefix('users')->group(static function () {
    // Создание клиента
    Route::get('create', static function () {
        return view('pages.master.user.create');
    })->name('master.user.create');

    // Список клиентов
    Route::get('', static function () {
        return view('pages.master.user.list');
    })->name('master.user.list');

    // Детальная страница клиента/список записей клиента
    Route::get('{id}', static function () {
        return view('pages.master.user.detail');
    })->name('master.user.detail');

    // Редактирование клиента
    Route::get('{id}/edit', static function () {
        return view('pages.master.user.edit');
    })->name('master.user.edit');

    // Создание записи для клиента
    Route::get('{id}/create_record', static function () {
        return view('pages.master.record.create');
    })->name('master.user.create_record');
});

Route::prefix('records')->group(static function () {
    // Список записей у мастера (всех)
    Route::get('', static function () {
        return view('pages.master.record.list');
    })->name('master.record.list');

    // Детальная информация о записи (не знаю что тут показывать)
//    Route::get('{id}', static function () {
//        return view('pages.master.record.detail');
//    })->name('master.record.detail');

    // Редактирование записи
    Route::get('{id}/edit', static function () {
        return view('pages.master.record.edit');
    })->name('master.record.edit');
});
