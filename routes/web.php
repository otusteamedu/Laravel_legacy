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



Route::view('/', 'HomeController@index')->name('home');

Route::get('/test',function () {
    return view('test');
});
Route::get('/news/{id}/{name}', function ($id, $name) {
    return view('welcome');
});


Route::group([
//    'as' => 'cms.',
    'prefix' => 'cms',
    'namespace' => 'Cms',
    /*'middleware' => [
        'auth',
    ],*/
], function () {

    //CmsFilters
    Route::namespace('Filters')->group(function () {
        $methods = ['index', 'edit', 'update', 'create', 'store', 'destroy'];
        Route::resource('filters', 'FiltersController')
            ->only($methods)
            ->names('cms.filters');
    });

    //CmsMpolls
    $methods = ['index', 'edit', 'update', 'create', 'store'];
    Route::namespace('Mpolls')->group(function () {
        $methods = ['index', 'edit', 'update', 'create', 'store'];
        Route::resource('mpolls', 'MpollsController')
            ->only($methods)
            ->names('cms.mpolls');
    });

    //CmsMlinks
    $methods = ['index', 'edit', 'update', 'create', 'store'];
    Route::namespace('Mlinks')->group(function () {
        $methods = ['index', 'edit', 'update', 'create', 'store'];
        Route::resource('mlinks', 'MlinksController')
            ->only($methods)
            ->names('cms.mlinks');
    });

    //CmsMstatuses
    $methods = ['index', 'edit', 'update', 'create', 'store'];
    Route::namespace('Mstatuses')->group(function () {
        $methods = ['index', 'edit', 'update', 'create', 'store'];
        Route::resource('mstatuses', 'MstatusesController')
            ->only($methods)
            ->names('cms.mstatuses');
    });

    //CmsMtypes
    $methods = ['index', 'edit', 'update', 'create', 'store'];
    Route::namespace('Mtypes')->group(function () {
        $methods = ['index', 'edit', 'update', 'create', 'store'];
        Route::resource('mtypes', 'MtypesController')
            ->only($methods)
            ->names('cms.mtypes');
    });

    //CmsQuotas
    $methods = ['index', 'edit', 'update', 'create', 'store'];
    Route::namespace('Quotas')->group(function () {
        $methods = ['index', 'edit', 'update', 'create', 'store'];
        Route::resource('quotas', 'QuotasController')
            ->only($methods)
            ->names('cms.quotas');
    });

    //CmsUsers
    $methods = ['index', 'edit', 'update', 'create', 'store'];
    Route::namespace('Users')->group(function () {
        $methods = ['index', 'edit', 'update', 'create', 'store'];
        Route::resource('users', 'UsersController')
            ->only($methods)
            ->names('cms.users');
    });

});


Route::get('/filters', 'Cms\Filters\FiltersController@index');


///////////////////////


/*Route::group($groupData, function (){
    //BlogCategory
    $methods = ['index', 'edit', 'update', 'create', 'store'];
    Route::resource('categories', 'CategoryController')
        ->only($methods)
        ->names('blog.admin.categories');

    //BlogPost
    Route::resource('posts', 'PostController')
        ->except(['show'])
        ->names('blog.admin.posts');
});*/

////////////////////////
