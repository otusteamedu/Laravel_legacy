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

/**
 * @var
 */

Route::name('admin.')->group(function (){
    Route::prefix('admin')->group(function (){
       Route::resource('category','Admin\CategoryProductController');
    });
});

Route::get('/', function () {


    /*
    $product = \App\Models\Products::first();


    $ss = $product->category;

    foreach ($ss as $item){
        echo $item->name;
    }

    dd($ss);
    $ss1 = $product->category()->get();

    //$ss2 = $product->category()->get();

   dd($ss1->product);
   /// dd($ss1->name);
//    dd($ss2);
    foreach ($ss2 as $tt){
//        echo $tt->id;
        echo $tt->name;
    }
*/
    return view('pages/homepage2');

});
Route::get('account', function () {
    return view('pages/account');
});
Route::get('login', function () {
    return view('pages/login');
});
Route::get('product', function () {
    return view('pages/product');
});
Route::get('cart', function () {
    return view('pages/cart');
});
Route::get('checkout', function () {
    return view('pages/checkout');
});
