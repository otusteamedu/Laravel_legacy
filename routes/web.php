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
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Category;

/*Route::get('/', function () {
    //$product = Product::find(3);
    //$productImage = new ProductImage;
    //$productImage->product_image = 'p12222.jpg';
    //$product->productImages()->save($productImage);
    //return $product->productImages;
    //return $product;

    //$category = Category::first();
    //return $category->products;
    //return $category->productImages;

    return view('site/index');
});*/

Route::get('/', 'IndexController@index')->name('index.index');

Route::get('/about', 'IndexController@about')->name('index.about');


Route::get('/user', function () {
    return view('site/user');
});

Route::get('/signUp', function () {
    return view('site/signUp');
});

Route::post('/signUp', function () {
    return view('site/pageInDevelopment');
});

Route::name('cms.')->group(function () {
    Route::prefix('cms')->group(function () {
        Route::resources([
            'categories' => 'Cms\Categories\CategoriesController',
            'products' => 'Cms\Products\ProductsController',
        ], [
            'except' => [
                'destroy',
            ],
        ]);
    });
});
