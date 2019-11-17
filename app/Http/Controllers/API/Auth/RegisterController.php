<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Requests\UserRegisterRequest;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\VerifyUser;
use App\Notifications\MailEmailVerification;
use Illuminate\Support\Facades\Hash;
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
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
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
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ])->attachRole('user');

        $user->verifyUser()->create([
            'token' => sha1(time())
        ]);

        $user->notify(new MailEmailVerification);

        return $user;
    }

    public function verifyUser($token)
    {
        $verifyUser = VerifyUser::where('token', $token)->first();
        $message = trans('auth.email_already_verified');
        if(isset($verifyUser) ){
            $user = $verifyUser->user;
            if(!$user->verified) {
                $verifyUser->user->verified = 1;
                $verifyUser->user->save();
                $message = trans('auth.email_verified');
            }
        } else {
            return redirect(env('CLIENT_BASE_URL') . '/login?danger=' . trans('auth.email_cannot_identified'));
        }
        return redirect(env('CLIENT_BASE_URL') . '/login?success=' . $message);
    }
}
