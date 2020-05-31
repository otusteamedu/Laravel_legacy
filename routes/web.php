<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/main', function () {
    return view('main.index');
});

Route::get('/user', function () {
    $tplName = 'user.index';

    $sidebarItems = [
        ['title' => 'item1', 'icon' => 'icon1'],
        ['title' => 'item2', 'icon' => 'icon1']
    ];

    $tplData = [
        'userName' => "Ivanov Ivan",
        'sidebarItems' => $sidebarItems
    ];

    return view($tplName, $tplData);
});

Route::get('service', function () {
    return view('static.service');
});
