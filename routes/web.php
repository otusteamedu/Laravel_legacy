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

$user = [
    'id'    => 1,
    'name'  => 'Александр',
    'email' => 'drek@inbox.ru',
    'image' => 'images/profile.jpg',
];

Route::get('/', function () {
    return view('auth.index')->with([
        'title' => __('auth/general.title'),
    ]);
});

Route::get('/auth/recover', function () {
    return view('auth.recover.index')->with([
        'title' => __('auth/recover.title'),
    ]);
});

Route::get('/profile', function () use ($user) {
    return view('profile.index')->with([
        'title' => $user['name'],
        'user'  => $user,
    ]);
});

Route::get('/profile/edit', function () use ($user) {
    return view('profile.edit')->with([
        'title' => __('profile/edit.title'),
        'user'  => $user,
    ]);
});

Route::get('/overview', function () use ($user) {
    return view('overview.index')->with([
        'user'     => $user,
        'title'    => __('overview/general.title'),
        'balance'  => 350,
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


Route::get('/test', function() {

    $project = \App\Models\Project::all()->random();
    dump($project, $project->users->random()->id);
});
