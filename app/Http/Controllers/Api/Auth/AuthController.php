<?php


namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Models\User;

class AuthController extends Controller
{

    public function register()
    {
        User::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => bcrypt(request('password'))
        ]);

        return response()->json([
            'message' => 'You were successfully registered. Use your email and password to sign in.'],
            ['status' => 201]
        );
    }

    public function login()
    {

        $data = [
            'grant_type' => 'password',
            'client_id' => 2,
            'client_secret' => 'm6w4qkQtOtcY4rV0iGPx18mdn2GNn5K1EARfbPhh',
            'username' => request('username'),
            'password' => request('password'),
        ];

        $request = Request::create('/oauth/token', 'POST', $data);

        return app()->handle($request);
    }


    public function logout()
    {
        $accessToken = auth()->user()->token();

        $refreshToken = DB::table('oauth_refresh_tokens')
            ->where('access_token_id', $accessToken->id)
            ->update([
                'revoked' => true
            ]);

        $accessToken->revoke();

        return response()->json(['status' => 200]);
//        return 'Protected route';
    }

}
