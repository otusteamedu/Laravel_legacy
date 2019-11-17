<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Requests\UserRegisterRequest;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Illuminate\Foundation\Auth\RegistersUsers;
use Tymon\JWTAuth\JWTAuth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    public function register(UserRegisterRequest $request)
    {
        $user = $this->create($request->all());

        return response()->json([
            'messages' => [
                'primary' => trans('auth.activation_code_sent', ['email' => $user->email])
            ]
        ], 200);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user = $this->userRepository->createWithRoleUser($data);
        $this->userRepository->sendEmailVerification($user);

        return $user;
    }

    /**
     * Check user for email confirmation and redirect on login page with success message.
     *
     * @param  string  $token
     * @return \Illuminate\Http\RedirectResponse
     */
    public function verifyUser($token)
    {
        $user = $this->userRepository->getUserVerify($token);

        $message = $this->userRepository->verifyUser($user)
            ? trans('auth.email_verified')
            : trans('auth.email_already_verified');

        return redirect(env('CLIENT_BASE_URL') . '/login?success=' . $message);
    }
}
