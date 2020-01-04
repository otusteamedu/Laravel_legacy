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
use App\Http\Controllers\LandingController;
use App\Http\Controllers\LandingRunController;
use App\Http\Controllers\ProjectController;

Route::get('/', [LandingController::class, 'index'])->name('landing.index');
Route::post('/run',[LandingRunController::class, 'run'])->name('landing.run');
Route::get('/result/{run}',[LandingRunController::class, 'result'])->name('landing.result');

Auth::routes();

Route::middleware('auth')->group(static function () {

    Route::get('home', [HomeController::class, 'index'])->name('home');

    Route::resource('projects', 'ProjectController');
    Route::post('projects/{project}/analyze', [ProjectController::class, 'analyze'])->name('projects.analyze');
    Route::get('projects/{project}/commits', [ProjectController::class, 'commits'])->name('projects.commits');
    Route::get('projects/{project}/commits/{hash}', [ProjectController::class, 'commitShow'])
        ->where('hash', '[0-9a-f]{40}')
        ->name('projects.commit');

});
