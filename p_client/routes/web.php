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
Route::get('/callback', function () {
    return view('callback');
});


Route::get('/redirect', function (\Illuminate\Http\Request $request) {

    $request->session()->put('state', $state= \Illuminate\Support\Str::random(40));
    $query = http_build_query([
        'client_id' => '11',
        'redirect_uri' => 'https://p_client.test/callback',
        'response_type' => 'code',
        'scope' => '',//$state,
    ]);

    return redirect('http://todo.test/oauth/authorize?'.$query);
});

Route::get('/callback', function (\Illuminate\Http\Request $request) {

   /* $state = $request->session()->pull('state');
    throw_unless(
        strlen($state) > 0 && $state === $request->state,
        InvalidArgumentException::class
    );
*/
    $http = new GuzzleHttp\Client;

    $response = $http->post('http://todo.test/oauth/token', [
        'form_params' => [
            'grant_type' => 'authorization_code',
            'client_id' => '11',
            'client_secret' => 'BxdfkKoUIc534txr644Wl7v8Kc5tvVfwU1JyC3IV',
            'redirect_uri' => 'https://p_client.test/callback',
            'code' => $request->code,
        ],
    ]);

    return json_decode((string) $response->getBody(), true);
});
