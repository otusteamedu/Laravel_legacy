<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\UserGroup;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

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
    protected $redirectTo = '/records';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('pages.login');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function authenticate(Request $request): RedirectResponse
    {
        $remember = $request->post('remember') === 'on';
        $credentials = $request->only('email', 'password');

        /** @var UserGroup $clientGroup */
        $clientGroup = UserGroup::whereIn('code', ['admin', 'master'])
            ->pluck('id')
            ->toArray();

        $credentials['group_id'] = $clientGroup;

        if (Auth::attempt($credentials, $remember)) {
            return \Redirect::route('master.record.list');
        }

        return \Redirect::back()->withErrors('Ошибка авторизации');
    }
}
