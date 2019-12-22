<?php

use GuzzleHttp\Exception\BadResponseException;

Route::name('admin.')->middleware('auth')->group(function() {
        Route::resources([
            'authors' => 'Authors\AuthorsController',
            'users' => 'Users\UsersController',
            'categories' => 'Categories\CategoriesController',
            'handbooks' => 'Handbooks\HandbooksController',
            'selection-materials' => 'SelectionMaterials\SelectionMaterialsController',
            'journals' => 'Journals\JournalsController',
            'materials' => 'Materials\MaterialsController',
            'favorites' => 'Favorites\FavoritesController',
            'reviews' => 'Reviews\ReviewsController',
            'compilations' => 'Compilations\CompilationsController',
        ]);
});


Route::auth();
Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/passport', function() {
    return view('passport.index');
})->middleware('auth')->name('passport');


Route::get('/redirect', function (Illuminate\Http\Request $request) {
    $request->session()->put('state', $state = Illuminate\Support\Str::random(40));
    $query = http_build_query([
        'client_id' => '13',
        'redirect_uri' => 'http://test.otus.localhost:7070/callback',
        'response_type' => 'token',
        'scope' => '',
        'state' => $state,
    ]);

    return redirect('http://test.otus.localhost:7070/oauth/authorize?'.$query);
})->name('token');


Route::get('/callback', function (Illuminate\Http\Request $request) {
//    $state = $request->session()->pull('state');
//
//    throw_unless(
//        strlen($state) > 0 && $state === $request->state,
//        InvalidArgumentException::class
//    );

    dd($request->code);
});
