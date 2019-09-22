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

Auth::routes();

Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

Route::name('web.')->group(function () {
    Route::get('/', function () {
        return view('web.static.home.index');
    })->name('home');
    
    Route::get('/contact', function () {
        return view('web.static.contact.index');
    })->name('contact');
});

Route::name('admin.')->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/', function () {
            return view('admin.dashboard.index');
        })->name('dashboard');
        
        Route::name('companies.')->group(function () {
            Route::prefix('companies')->group(function () {
                Route::patch('/{id}/restore', 'Admin\CompanyController@restore')->name('restore');
                Route::delete('/{id}/force-delete', 'Admin\CompanyController@forceDelete')->name('force_delete');
            });
        });
        
        Route::name('leads.')->group(function () {
            Route::prefix('leads')->group(function () {
                Route::patch('/{id}/restore', 'Admin\LeadController@restore')->name('restore');
                Route::delete('/{id}/force-delete', 'Admin\LeadController@forceDelete')->name('force_delete');
            });
        });
        
        Route::name('widgets.')->group(function () {
            Route::prefix('widgets')->group(function () {
                Route::patch('/{id}/restore', 'Admin\WidgetController@restore')->name('restore');
                Route::delete('/{id}/force-delete', 'Admin\WidgetController@forceDelete')->name('force_delete');
            });
        });
        
        Route::name('users.')->group(function () {
            Route::prefix('users')->group(function () {
                Route::patch('/{id}/restore', 'Admin\UserController@restore')->name('restore');
                Route::delete('/{id}/force-delete', 'Admin\UserController@forceDelete')->name('force_delete');
            });
        });
        
        Route::name('conversations.')->group(function () {
            Route::prefix('conversations')->group(function () {
                Route::patch('/{id}/restore', 'Admin\ConversationController@restore')->name('restore');
                Route::delete('/{id}/force-delete', 'Admin\ConversationController@forceDelete')->name('force_delete');
            });
        });
        
        Route::resources([
            'companies'     => 'Admin\CompanyController',
            'leads'         => 'Admin\LeadController',
            'widgets'       => 'Admin\WidgetController',
            'users'         => 'Admin\UserController',
            'conversations' => 'Admin\ConversationController'
        ], ['except' => 'show']);
    });
});
