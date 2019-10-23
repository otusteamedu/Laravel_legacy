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


Route::name('admin.')->group(function () {
    App::setLocale('ru');
    Route::prefix('admin')->group(function () {
        Route::resources([
            'users' => 'Admin\UsersController',
            'roles' => 'Admin\RolesController',
            'statuses' => 'Admin\StatusesController',
            'permissions' => 'Admin\PermissionsController',
            '/' => 'Admin\AdminController',

            // 'cities' => 'Cms\Cities\CitiesController',
        ]);
    });
});

Route::get('/', function () {


    $data = [
        'title' => 'TikTak - оптимальный сервис для управления своими задачами',
        'description' => ' Вот что мы знаем о нем',

    ];
    return view('index', $data);
});
/*
Route::get('/tasks', function () {

    $tasks = [
        [
            'id' => 1,
            'title' => 'Собрать вещи',
            'description' => 'Собрать три коробки вещей',

        ],
        [
            'id' => 2,
            'title' => 'Создание страниц',
            'description' => 'Нарисовать струткру сущностей, создать три 4 страницы ',

        ],
        [
            'id' => 3,
            'title' => 'Тренировка',
            'description' => 'Позаниматься йогой по схеме 22',

        ],

    ];
    $data = [
        'tasks' => $tasks,
        'title' => 'TikTak - оптимальный сервис для управления своими задачами',
        'description' => ' Вот что мы знаем о нем',

    ];

   // return view('tasks.index', $data);

});
*/
Route::get('/tasks', 'Site\TasksController@index')->name('tasks');

Route::get('/registration', function () {

    $data = [

        'title' => 'TikTak - оптимальный сервис для управления своими задачами',
        'description' => ' Вот что мы знаем о нем',

    ];
    return view('registration.index', $data);
});

Route::get('/login', function () {

    $data = [

        'title' => 'TikTak - оптимальный сервис для управления своими задачами',
        'description' => ' Вот что мы знаем о нем',

    ];
    return view('registration.login', $data);
});
Route::get('/about', function () {

    $data = [

        'title' => 'TikTak - оптимальный сервис для управления своими задачами',
        'description' => ' Вот что мы знаем о нем',

    ];
    return view('about.index', $data);
});

Route::get('/help', function () {

    $data = [

        'title' => 'TikTak - оптимальный сервис для управления своими задачами',
        'description' => ' Вот что мы знаем о нем',

    ];
    return view('help.index', $data);
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
