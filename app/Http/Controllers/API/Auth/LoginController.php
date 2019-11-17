<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest;
use App\Http\Resources\User as UserResource;
use App\Notifications\MailEmailVerification;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\JWTAuth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '';

    protected $auth;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(JWTAuth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(UserLoginRequest $request)
    {
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return response()->json([
                'messages' => [
                    'danger' => trans('auth.locked_out')
                ]
            ], 403);
        }

        $this->incrementLoginAttempts($request);

        if (!$token = $this->auth->attempt($request->only('email', 'password'))) {
            return response()->json([
                'errors' => 'incorrectly',
                'messages' => [
                    'danger' => trans('auth.wrong_login_pass')
                ]
            ], 422);
        };

        if ($request->user()->verified && $request->user()->publish) {
            return response()->json([
                'data' => new UserResource($request->user()),
                'messages' => [
                    'success' => trans('auth.welcome_message', ['name' => $request->user()->name])
                ],
                'token' => $token
            ], 200);
        } else if (!$request->user()->verified) {
            $request->user()->notify(new MailEmailVerification());

            return response()->json([
                'messages' => [
                    'warning' => trans('auth.activation_code_sent', ['email' => $request->user()->email])
                ]
            ], 200);
        } else if (!$request->user()->publish) {

            return response()->json([
                'messages' => [
                    'danger' => trans('auth.locked_out')
                ]
            ], 403);
        }

    }
}
