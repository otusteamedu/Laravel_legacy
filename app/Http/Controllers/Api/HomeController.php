<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class HomeController extends Controller
{
    public function getToken(Request $request)
    {
        $email = $request->get('email') ?? '';
        $password = $request->get('password') ?? '';

        if (\Auth::attempt(['email' => $email, 'password' => $password])) {
            $user = User::where('email', $email)
                ->first();

            if (!empty($user)) {
                return response()->json(['data' => ['api_token' => $user->api_token]], 200);
            }
        }

        return response()->json('Invalid data', 400);
    }
}
