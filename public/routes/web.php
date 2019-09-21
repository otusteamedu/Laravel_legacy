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

Route::group(['prefix'=>'admin','namespace'=>'Admin'],function(){
    Route::get('/','DashboardController@dashboard')->name('admin.index');
    Route::resource('/groups','GroupsController',['as'=>'admin']);
    Route::resource('/responsibilities','ResponsibilitiesController',['as'=>'admin']);
    Route::resource('/reasons','ReasonsController',['as'=>'admin']);
});


Route::get('/', function () {
    return view('dashboard.index')
        ->with('title', 'Главная страница')
        ->with('description', 'Описание главной страницы');
});


Route::get('/clear', function() {
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    //Artisan::call('backup:clean');
    return "Кэш очищен.";
});


Route::get('/info', function () {
    return phpinfo();
});
Route::get('/group', function () {
    return view('group.index', ['title' => 'Создание группы', 'description' => 'описание страницы создание группы']);
});

Route::get('/flow', function ($page='flow') {
    return view($page.'.index', ['title' => 'Страница ' . $page, 'description' => 'Описаие страницы ' . $page])
        ->with('arItem',[
            ['name'=>'Имя', 'var1'=>'значение 1', 'count'=> '235'],
            ['name'=>'Имя1', 'var1'=>'значение 13', 'count'=> '100'],
            ['name'=>'Имя2', 'var1'=>'значение4', 'count'=> '26'],
            ['name'=>'Имя3', 'var1'=>'значенd', 'count'=> '5'],
            ['name'=>'Имя4', 'var1'=>'значение w', 'count'=> '2005'],
        ] );
})->name('flow');

//Route::redirect('/test', 'http://ya.ru');

Route::get('/{page}', function ($page) {
    return view($page.'.index', ['title' => 'Страница ' . $page, 'description' => 'Описаие страницы ' . $page]);
});


Route::get('/dashboard', function () {
    return view('dashboard.index');
});



//
//Route::get('/user', function () {
//    return 'user';
//});
//
//Route::get('/group', function () {
//    return 'group';
//});
//
//Route::get('/responsibility', function () {
//    return 'responsibility';
//});
//
//Route::get('/reason', function () {
//    return 'reason';
//});
//
//Route::get('/flow', function () {
//    return 'flow';
//});


//$patterns = [
//    'id' => '\d+',
//    'hash' => '[a-z0-9]+',
//    'uuid' => '[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}',
//    'slug' => '[a-z0-9-]+',
//    'token' => '[a-zA-Z0-9]{64}',
//];


