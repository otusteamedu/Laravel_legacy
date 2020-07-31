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
});


Route::get('/records', function () {
    return view('records.history');
});
Route::get('/staff', function () {
    return view('staff.index');
});
Route::get('/procedures', function () {
    return view('procedures.index');
});
Route::get('/statistic', function () {
    return view('statistic.index');
});
Route::get('/business', function () {
    return view('business.index');
});
Route::get('/feedback', function () {
    return view('feedback.index');
});
Route::get('/message', function () {
    return view('message.index');
});

Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'middleware' => [
        // TODO: Добавсить авторизацию для администратора
    ]
], function () {
    Route::resources([
        'business' => 'Admin\BusinessController',
        'procedure' => 'Admin\ProcedureController',
    ]);
});

Auth::routes();
