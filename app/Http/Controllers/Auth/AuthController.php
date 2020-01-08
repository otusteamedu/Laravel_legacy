<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Auth\Requests\LoginFormRequest;
use App\Http\Controllers\Auth\Requests\RegisterFormRequest;
use App\Http\Controllers\Controller;
use App\Services\Auth\AuthService;

/**
 * Class AuthController
 * @package App\Http\Controllers\Auth
 */
class AuthController extends Controller
{
    /**
     * @var AuthService
     */
    private $authService;
    /**
     * @var bool
     */
    public $loginAfterSignUp = true;

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct(AuthService $service)
    {
        $this->authService = $service;
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }


    /**
     * @param LoginFormRequest $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function login(LoginFormRequest $request)
    {
        $credentials = $request->getData();
        $token = $this->authService->getApiToken($credentials);
        if (!$token) {
            return response([
                'status' => 'error',
                'error' => 'invalid.credentials',
                'msg' => 'Invalid Credentials.'
            ], 400);
        }
        return $this->respondWithToken($token);
    }


    /**
     * @param RegisterFormRequest $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function register(RegisterFormRequest $request)
    {
        $data = $request->getData();
        $user = $this->authService->registerNewUser($data);

        if ($user) {
            return response([
                'status' => 'success',
                'data' => $user
            ], 200);
        }
        return response([
            'status' => 'error',
            'error' => 500,
            'msg' => 'Что-то пошло не так'
        ], 500);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        $this->authService->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        $token = $this->authService->refreshToken();
        return $this->respondWithToken($token);
    }

    /**
     * Get the token array structure.
     *
     * @param string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ])
            ->header('Authorization', $token);
    }
}
