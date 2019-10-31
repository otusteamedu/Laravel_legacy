<?php

namespace App\Http\Controllers\Auth;

use App\Http\Middleware\Auth\HashPassword;
use App\Http\Requests\Users\Web\RegisterUser;
use App\Http\Controllers\Controller;
use App\Services\Users\UserService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;

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
    protected $redirectTo = '/admin';
    
    private $userService;
    
    /**
     * Create a new controller instance.
     *
     * @param  UserService  $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    
        $this->middleware('guest');
    }
    
    /**
     * Handle a registration request for the application.
     *
     * @param  RegisterUser  $request
     *
     * @return mixed
     */
    public function register(RegisterUser $request)
    {
        $user = $this->userService->createUser($request->all());
        
        event(new Registered($user));
        
        $this->guard()->login($user);
        
        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }
}
