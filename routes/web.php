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

use Illuminate\Support\Facades\Log;

Route::name('admin.')->group(function () {
    Route::prefix('{locale}/admin')
        ->middleware(['auth','localize'])
        ->group(function () {
            Route::resources([
                '/' => 'Admin\CategoryProduct\CategoryProductController',
                'category' => 'Admin\CategoryProduct\CategoryProductController',
                'product' => 'Admin\Product\ProductController',
            ], [
                'except' => [
                    'show',
                ],
            ]);
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

})->name('home');
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
Route::get('checkout', function (){
    return view('pages/checkout');
});

Auth::routes();

Route::get('logme', function (){
    Log::info('логирование удалось');
    Log::warning('Что-то может идти не так.');
    Log::error('Что-то действительно идёт не так.');
});

//Route::get('/home', 'HomeController@index')->name('home');
