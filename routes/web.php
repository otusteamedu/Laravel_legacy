<?php
Route::group(['middleware' => 'auth'], function () {

    Route::get('/', 'HomeController@index')->name('home');

    Route::get('/bot-settings/', 'BotSettings\BotSettingsController@index')->name('bot-settings-index');


    Route::get('/lang-constructor/', 'LangConstructor\LangConstructorController@index')->name('lang-constructor-index');
    Route::get('/lang-constructor/edit/{id?}', 'LangConstructor\LangConstructorController@edit')->name('lang-constructor-edit');
    Route::post('/lang-constructor/save', 'LangConstructor\LangConstructorController@save')->name('lang-constructor-save');
    Route::get('/lang-constructor/delete/{id}', 'LangConstructor\LangConstructorController@delete')->name('lang-constructor-delete');


    Route::get('/lang-constructor-type/', 'LangConstructor\LangConstructorTypeController@index')->name('lang-constructor-type-index');
    Route::get('/lang-constructor-type/edit/{id?}', 'LangConstructor\LangConstructorTypeController@edit')->name('lang-constructor-type-edit');
    Route::post('/lang-constructor-type/save', 'LangConstructor\LangConstructorTypeController@save')->name('lang-constructor-type-save');
    Route::get('/lang-constructor-type/delete/{id}', 'LangConstructor\LangConstructorTypeController@delete')->name('lang-constructor-type-delete');

});


Auth::routes();


