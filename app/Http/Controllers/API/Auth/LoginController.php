<?php

namespace App\Http\Controllers\API\Auth;

use App\Helpers\Patterns\Strategies\ResponseUserStatus\LoginJsonResponseUserStatusStrategy;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest;
use App\Http\Resources\User as UserResource;
use App\Repositories\UserRepository;
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

    use LoginJsonResponseUserStatusStrategy;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '',
        $auth,
        $userRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(JWTAuth $auth, UserRepository $userRepository)
    {
        $this->auth = $auth;
        $this->userRepository = $userRepository;
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \App\Http\Requests\UserLoginRequest  $request
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
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

        $token = $this->auth->attempt($request->only('email', 'password'));

        return $token
            ? $this->getUserStatusResponse($request->user(), $token, $this->userRepository)
            : response()->json([
                'errors' => 'incorrectly',
                'messages' => [
                    'danger' => trans('auth.wrong_login_pass')
                ]
            ], 422);
    }
}
