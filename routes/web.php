<?php

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

$user = [
    'id'    => 1,
    'name'  => 'Александр',
    'email' => 'drek@inbox.ru',
    'image' => 'images/profile.jpg',
];

Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('overview.index')->with([
            'title'    => __('overview/general.title'),
            'balance'  => Auth::user()->balance,
            'projects' => [
                [
                    'name'    => 'OTUS',
                    'new'     => 3,
                    'ended'   => 1,
                    'process' => 2,
                ],
                [
                    'name'    => 'Code',
                    'new'     => 2,
                    'ended'   => 3,
                    'process' => 5,
                ],
            ],
            'tasks'    => [
                'today'    => 10,
                'tomorrow' => 17,
            ],
        ]);
    });

    Route::resources([
        'staffs' => 'Staffs\Staffs',
        'clients' => 'Clients\Clients',
        'projects' => 'Projects\Projects',
    ]);
});

Auth::routes(['register' => false]);



