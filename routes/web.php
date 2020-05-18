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

Route::get('/company/{company}/products', function (int $company_id) {

    $company = \App\Models\Company::findOrFail($company_id);

    $products = \App\Models\Product::get();

    $product = \App\Models\Product::where(function(\Illuminate\Database\Eloquent\Builder $builder) {
        $builder->where('price', '>', 10)
            ->orWhere('price', '<', 5);
    })->where('created_at', '>', '2020-05-18')->toSql();


    $products->load([
       'company',
       'company.city',
    ]);

    $products->loadMissing([
        'company',
        'company.city.country',
    ]);


    $data = [
        'company' => $company,
        'products' => $products,
    ];

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

