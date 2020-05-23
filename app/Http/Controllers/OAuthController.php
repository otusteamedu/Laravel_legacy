<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OAuthController extends Controller
{
    public function redirect($request)
    {
        $request->session()->put('state', $state = \Str::random(40));

        $query = http_build_query([
            'client_id' => '3',
            'redirect_uri' => 'http://laravel2.loc/admin/student',
            'response_type' => 'code',
            'scope' => 'user.students',
            'state' => $state,
        ]);

        return redirect('http://laravel2.loc/oauth/authorize?'.$query);
    }

    public function callback($request)
    {
        $state = $request->session()->pull('state');

        throw_unless(
            strlen($state) > 0 && $state === $request->state,
            \InvalidArgumentException::class
        );

        if($request->has('error')){
            session()->flash('login_error', 'Canceled');
            return redirect()->route('login');
        }

        $http = new \GuzzleHttp\Client;

        $response = $http->post('http://laravel2.loc/oauth/token', [
            'form_params' => [
                'grant_type' => 'authorization_code',
                'client_id' => '3',
                'client_secret' => 'Jmr1nR2yOEg1GuH5SoH2dzfKCG69m67sUrGoS0tU',
                'redirect_uri' => 'http://laravel2.loc/admin/student',
                'code' => $request->code,
            ],
        ]);

        return json_decode((string) $response->getBody(), true);
    }
}
