<?php

namespace App\Http\Controllers\Api\Cms\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Cms\Auth\Requests\RegisterFormRequest;

class RegisterController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(RegisterFormRequest $request)
    {
        //
        $user = User::create(array_merge(
            $request->only('firstname','lastname', 'email'),
            ['password' => bcrypt($request->password)],
        ));

        return response()->json([
            'message' => 'You were successfully registered. Use your email and password to sign in.'
        ], 200);
    }
}
