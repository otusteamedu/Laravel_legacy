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

Route::get('/', function () {
    //$product = Product::find(3);
    //$productImage = new ProductImage;
    //$productImage->product_image = 'p12222.jpg';
    //$product->productImages()->save($productImage);
    //return $product->productImages;
    //return $product;
    return view('site/index');
});

Route::get('/about', function () {
    //$category = Category::first();
    //return $category->products;
    //return $category->productImages;
    return view('site/about');
});

Route::get('/user', function () {
    return view('site/user');
});

Route::get('/signUp', function () {
    return view('site/sign-up');
});

Route::post('/signUp', function () {
    return view('site/page-in-development');
});
