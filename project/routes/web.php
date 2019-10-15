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

Route::name('public.')->group(function(){
    Route::get('/', function (){
        return view('public.home');
    })->name('home');

    Route::name('account.')->group(function(){
        Route::get('/personal_data', function (){
            return view('public.account.personal_data');
        })->name('personal_data');

        Route::get('/favorites', function (){
            return view('public.account.favorites');
        })->name('favorites');
    });
});

//Route::name('admin.')->group(function(){
//    Route::get('/', function (){
//        return view('admin.home');
//    })->name('home');
//
//    Route::name('stock.')->group(function(){
//        Route::get('/stocks', function (){
//            return view('admin.stock.list');
//        })->name('list');
//
//        Route::get('/stock/{id}', function (){
//            return view('admin.stock.edit');
//        })->name('edit');
//
//        Route::name('property.')->group(function() {
//            Route::get('/stocks/properties', function () {
//                return view('admin.stock.property.list');
//            })->name('list');
//
//            Route::get('/stocks/property/{id}', function () {
//                return view('admin.stock.property.edit');
//            })->name('edit');
//
//            Route::name('category.')->group(function() {
//                Route::get('/stocks/properties/categories', function () {
//                    return view('admin.stock.property.category.list');
//                })->name('list');
//
//                Route::get('/stocks/properties/category/{id}', function () {
//                    return view('admin.stock.property.category.edit');
//                })->name('edit');
//            });
//        });
//    });
//
//    //@todo path for editing users
//});

Route::prefix('admin')->name('admin.')->namespace('Admin')->middleware('auth') ->group(function (){
    Route::get('/', 'HomeController@index')->name('home');
    Route::prefix('stock')->name('stock.')->namespace('Stock')->group( function (){
        Route::resource('/', 'StockController' );
    });

//    Route::name('stock.')->group(function(){
//        Route::get('/stocks', function (){
//            return view('admin.stock.list');
//        })->name('list');
//
//        Route::get('/stock/{id}', function (){
//            return view('admin.stock.edit');
//        })->name('edit');
//
//        Route::name('property.')->group(function() {
//            Route::get('/stocks/properties', function () {
//                return view('admin.stock.property.list');
//            })->name('list');
//
//            Route::get('/stocks/property/{id}', function () {
//                return view('admin.stock.property.edit');
//            })->name('edit');
//
//            Route::name('category.')->group(function() {
//                Route::get('/stocks/properties/categories', function () {
//                    return view('admin.stock.property.category.list');
//                })->name('list');
//
//                Route::get('/stocks/properties/category/{id}', function () {
//                    return view('admin.stock.property.category.edit');
//                })->name('edit');
//            });
//        });
//    });
});
Auth::routes();
