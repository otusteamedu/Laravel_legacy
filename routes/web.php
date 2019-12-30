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
use App\Models\User;
use Illuminate\Support\Facades\DB;

Route::get('/{any}', 'SpaController@index')->where('any', '.*');

Route::get('/admin/{any}', 'AdminSpaController@index')->where('any', '.*');

Route::get('/test', function () {
    $rt = DB::table('users', 'u')
        ->select(['u.id', 'u.username', 'u.email', 'roles.title'])
        ->join('roles', 'u.role_id', '=', 'roles.id')
        ->get();
    dd($rt);
});


