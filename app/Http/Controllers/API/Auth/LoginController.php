<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\API\Auth\ResponseUserStatus\LoginJsonResponseUserStatusStrategy;
use App\Http\Controllers\API\Auth\Base\BaseLoginController;
use App\Http\Controllers\API\Cms\User\Requests\UserLoginRequest;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends BaseLoginController
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
    protected $redirectTo = '';

    /**
     * @param UserLoginRequest $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function login(UserLoginRequest $request)
    {
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return response()->json([
                'message' => [
                    'text' => trans('auth.locked_out'),
                    'status' => 'danger'
                ]
            ], 403);
        }

        $this->incrementLoginAttempts($request);

        $token = $this->auth->attempt($request->only('email', 'password'));

        return $token
            ? $this->getUserStatusResponse($request->user(), $token)

            : response()->json([
                'errors' => 'incorrectly',
                'message' => [
                    'text' => trans('auth.wrong_login_pass'),
                    'status' => 'danger'
                ]
            ], 422);
    }
}
