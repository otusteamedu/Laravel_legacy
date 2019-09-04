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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/plain/index', function () {
    return view('plain.index');
});

Route::get('/plain/includes', function () {
    return view('plain.includes');
});
Route::get('/plain/for', function () {
    return view('plain.for');
});

Route::get('/plain/foreach', function () {
    return view('plain.foreach');
});

Route::get('/products/create', function () {
    $company = [
        'id' => 1,
        'name' => 'Otus',
        'url' => '/companies/1',
    ];
    $data = [
        'company' => $company,
    ];
    return view('products.create', $data);
});

Route::get('/products', function () {
    $company = [
        'id' => 1,
        'name' => 'Otus',
        'url' => '/companies/1',
    ];
    $products = [
        [
            'id' => 1,
            'title' => 'Pepsi',
            'price' => 10,
            'remainingCount' => 5,
            'totalCount' => 50,
            'created_at' => \Carbon\Carbon::now()->subDays(2),
        ],
        [
            'id' => 2,
            'title' => 'Sprite',
            'price' => 10,
            'remainingCount' => 7,
            'totalCount' => 50,
            'created_at' => \Carbon\Carbon::now()->subDays(5),
        ],
        [
            'id' => 3,
            'title' => 'Fanta orange',
            'price' => 11,
            'remainingCount' => 1,
            'totalCount' => 50,
            'created_at' => \Carbon\Carbon::now()->subDays(3),
        ],
        [
            'id' => 4,
            'title' => 'Aqua Minerale',
            'price' => 8.5,
            'remainingCount' => 77,
            'totalCount' => 100,
            'created_at' => \Carbon\Carbon::now()->subDays(4),
        ],
        [
            'id' => 5,
            'title' => 'Blue Ice',
            'price' => 20,
            'remainingCount' => 0,
            'totalCount' => 50,
            'created_at' => \Carbon\Carbon::now()->subDays(5),
        ],
        [
            'id' => 6,
            'title' => '7up',
            'price' => 12,
            'remainingCount' => 15,
            'totalCount' => 50,
            'created_at' => \Carbon\Carbon::now()->subDays(12),
        ],
    ];
    $data = [
        'company' => $company,
        'products' => $products,
    ];

//    \App\Models\Product::join('companies', 'company_id', '=', 'product_id');

    return view('products.index', $data);
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/companies/create', function () {

    return view('companies.create');
});
Route::get('/companies', function () {
    $data = [
        'companies' => \App\Models\Company::paginate(50),
    ];
    return view('companies.index', $data);
});
