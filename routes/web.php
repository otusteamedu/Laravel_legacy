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

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;

// вход|выход
Route::get('/account/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/account/login', 'Auth\LoginController@login');
Route::post('/account/logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/account/register', 'Auth\RegisterController@showRegistrationForm')->name('public.account.register');
Route::post('/account/register', 'Auth\RegisterController@register');


Route::get('/account/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('/account/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('/account/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('/account/password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');
Route::get('/account/email/verify', 'Auth\VerificationController@show')->name('verification.notice');
Route::get('/account/email/verify/{id}/{hash}', 'Auth\VerificationController@verify')->name('verification.verify');
Route::post('/account/email/resend', 'Auth\VerificationController@resend')->name('verification.resend');

/**/
Route::name('admin.')->prefix('manager')->middleware(['auth', 'manager'])->group(function () {
    Route::resource('countries', 'Admin\Movies\CountryController')->except(['show']);
    Route::resource('genres', 'Admin\Movies\GenreController')->except(['show']);
    Route::resource('people', 'Admin\Movies\PersonController')->except(['show']);
    // Route::resource('movies', 'Admin\Movies\MovieController')->except(['show']);

    Route::name('movies.')->prefix('movies')->group(function () {
        Route::get('', 'Admin\Movies\Movie\MovieListController@index')->name('index');
        Route::get('/create', 'Admin\Movies\Movie\MovieFormController@create')->name('create');
        Route::post('/create', 'Admin\Movies\Movie\MovieFormController@store')->name('store');
        Route::get('/edit/{itemId}', 'Admin\Movies\Movie\MovieFormController@edit')->where(['itemId' => '[0-9]+'])->name('edit');
        Route::match(['put', 'patch'], '/edit/{itemId}', 'Admin\Movies\Movie\MovieFormController@update')->name('update');
        Route::delete('/{itemId}', 'Admin\Movies\Movie\MovieListController@destroy')->where(['itemId' => '[0-9]+'])->name('destroy');
    });

    Route::name('users.')->prefix('users')->group(function () {
        Route::get('', 'Admin\Security\User\UserListController@index')->name('index');
        Route::get('/create', 'Admin\Security\User\UserFormController@create')->name('create');
        Route::post('/create', 'Admin\Security\User\UserFormController@store')->name('store');
        Route::get('/edit/{itemId}', 'Admin\Security\User\UserFormController@edit')->where(['itemId' => '[0-9]+'])->name('edit');
        Route::match(['put', 'patch'], '/edit/{itemId}', 'Admin\Security\User\UserFormController@update')->name('update');
        Route::delete('/{itemId}', 'Admin\Security\User\UserListController@destroy')->where(['itemId' => '[0-9]+'])->name('destroy');
    });

    // Route::resource('movies', 'Admin\Movies\MovieController')->except(['show']);

    Route::name('security.')->prefix('security')->group(function () {
        Route::get('', 'Admin\Security\PermController@index')->name('index');
        Route::match(['put', 'patch'], '', 'Admin\Security\PermController@save')->name('save');
    });
});

Route::get('/', 'Publica\StartController@index')->name('public.start');
Route::get('/about', 'Publica\StartController@about')->name('public.about');
Route::get('/test', 'Publica\TestController@index')->name('public.test');
Route::get('/movies', 'Publica\MovieController@index')->name('public.movies.search');
Route::get('/movies/view/{id}', 'Publica\MovieController@view')->where(['id' => '[0-9]+'])->name('public.movies.view');
Route::get('/movies/premier', 'Publica\MovieController@soon')->name('public.movies.premier');

Route::get('/movies/showing/{id}', 'Publica\MovieShowingController@showing')->where(['id' => '[0-9]+'])->name('public.movies.showing');
Route::get('/movies/order/{id}', 'Publica\MovieShowingController@order')->where(['id' => '[0-9]+'])->name('public.movies.order');
Route::get('/movies/showing/tickets', 'Publica\MovieShowingController@ticketData')->name('public.movies.showing.tickets');

Route::get('/order/getsession', 'Publica\OrderController@sessionData')->name('public.order.getsession');
Route::any('/order/addticket', 'Publica\OrderController@addTicket')->name('public.order.addticket');
Route::any('/order/removeticket', 'Publica\OrderController@removeTicket')->name('public.order.removeticket');
Route::any('/order/removeitem', 'Publica\OrderController@removeItem')->name('public.order.removeitem');

Route::get('/order/checkout', 'Publica\OrderController@checkoutOrder')->name('public.order.checkout');
Route::post('/order/checkout', 'Publica\OrderController@confirmOrder')->name('public.order.confirm');
Route::get('/order/confirmed', 'Publica\OrderController@confirmedOrder')->name('public.order.confirmed');
Route::get('/order/auth', 'Publica\OrderController@authOrder')->name('public.order.auth');
Route::post('/order/register', 'Publica\OrderController@quickRegister')->name('public.order.register');

// оплата
Route::middleware('auth')->group(function () {
    Route::get('/order/pay', 'Publica\PaymentController@createPayment')->name('public.payment.pay');
    Route::get('/order/payinput', 'Publica\PaymentController@inputFormPayment')->name('public.payment.input');
    Route::post('/order/payinput', 'Publica\PaymentController@inputSavePayment')->name('public.payment.save');
    Route::any('/order/payprocess', 'Publica\PaymentController@processPayment')->name('public.payment.process');
    Route::get('/order/paystatus', 'Publica\PaymentController@paymentStatus')->name('public.payment.status');
});

Route::get('/movies/archived', function () {
    return view('public');
})->name('public.movies.archived');

Route::get('/cinemas', 'Publica\CinemaController@index')->name('public.cinemas.index');
Route::get('/cinemas/{id}', 'Publica\CinemaController@view')->where(['id' => '[0-9]+'])->name('public.cinemas.item');
Route::get('/cinemas/map_data', 'Publica\CinemaController@mapData')->name('public.cinemas.json');

Route::middleware('auth')->get('/manager', function () {
    //Log::debug('ffff');
    return view('admin.start.index');
})->name('admin.index');


Route::get('/account', function () {
    return view('public.account.index', [
        'breadCrumbs' => [
            [
                'url' => \route('public.start'),
                'title' => __('public.menu.home'),
            ],
            [
                'url' => \route('public.account.index'),
                'title' => __('public.account.index'),
            ]
        ]
    ]);
})->name('public.account.index');

Route::get('/account/order/{number}', function () {
    return view('public.account.order');
})->name('public.account.order');

Route::get('/account/ordered', function (\Illuminate\Http\Request $request, \App\Services\OrderService $orderService) {
    $status = (string) $request->get('status');
    $ordersList = $orderService->getMyOrderList($status);

    return view('public.account.ordered', compact('ordersList'));
})->name('public.account.ordered');

/*
Route::get('/account/register', function () {
    return view('public.account.register', [
        'breadCrumbs' => [
            [
                'url' => \route('public.start'),
                'title' => __('public.menu.home'),
            ], [
                'url' => \route('public.account.index'),
                'title' => __('public.account.index'),
            ], [
                'url' => \route('public.account.register'),
                'title' => __('public.account.register'),
            ]
        ]
    ]);
})->name('public.account.register');
*/

Route::get('/account/profile', function () {

})->name('public.account.profile');



