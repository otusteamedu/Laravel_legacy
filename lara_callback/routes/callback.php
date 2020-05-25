<?php

use Lara\Callback\Http\CallbackController;

Route::group(['prefix' => 'callback','as' => 'callback.'],function (){
    Route::get('/',[ CallbackController::class, 'index'])->name('index');
    Route::post('/send',[ CallbackController::class, 'send'])->name('send');
});
