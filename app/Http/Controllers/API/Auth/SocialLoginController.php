<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Requests\UserSocialRequest;
use App\Models\User;
use App\Models\UserSocial;
use App\Notifications\MailEmailVerification;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Tymon\JWTAuth\JWTAuth;

class SocialLoginController extends Controller
{
    protected $auth;

    public function __construct(JWTAuth $auth)
    {
        $this->auth = $auth;
        $this->middleware('social');
    }

    public function redirect($service)
    {
        return Socialite::driver($service)->stateless()->redirect();
    }

    public function registered($service, UserSocialRequest $request)
    {
        $user = $this->createUser($request);

        return response()->json([
            'messages' => [
                'primary' => trans('auth.activation_code_sent', ['email' => $user->email])
            ]
        ], 200);
    }

    public function callback($service)
    {
        try {
            $serviceUser = Socialite::driver($service)->stateless()->user();
        } catch (\Exception $e) {
            return redirect(env('CLIENT_BASE_URL')
                . '/social-callback?'
                . 'danger=' .trans('auth.unable_using_service', ['service' => Str::title($service)])
                . '&origin=login');
        }

        $newUserSocial = false;

        $user = $this->getExistingUserSocial($serviceUser);

        if (!$user) {
            $newUserSocial = true;

            $user = User::where('email', $serviceUser->getEmail())->first();

            if ($user) {
                $this->createUserSocial($user, $serviceUser->getId(), $service);
            } else {
                // Подумать над тем, чтобы направлять пользователя на /registration
                return redirect(env('CLIENT_BASE_URL')
                    . '/social-callback?'
                    . 'name=' . ($serviceUser->getName() ? $serviceUser->getName() : '')
                    . '&email=' . ($serviceUser->getEmail() ? $serviceUser->getEmail() : '')
                    . '&social_id=' . $serviceUser->getId()
                    . '&service=' . $service
                );
            }
        }

        if ($user->verified && $user->publish) {
            return redirect(env('CLIENT_BASE_URL')
                . '/social-callback?'
                . 'origin=login'
                . '&success=' . trans('auth.welcome_message', ['name' => $user->name])
                . '&token=' . $this->auth->fromUser($user)
            );
        } else if (!$user->verified){
            $this->sendVerifyMail($user);
            return redirect(env('CLIENT_BASE_URL')
                . '/social-callback?'
                . 'origin=' . ($newUserSocial ? 'register' : 'login')
                . '&no_verified=true'
                . '&warning=' . trans('auth.activation_code_sent', ['email' => $user->email])
            );
        } else if (!$user->publish) {
            return redirect(env('CLIENT_BASE_URL')
                . '/social-callback?'
                . 'origin=login'
                . '&no_verified=true'
                . '&danger=' . trans('auth.locked_out'), 403);
        }
    }

    public function needsToCreateSocial(User $user, $service)
    {
        return !$user->hasSocialLinked($service);
    }

    public function getExistingUserSocial($serviceUser)
    {
        $userSocial = UserSocial::where('social_id', $serviceUser->getId())->first();
        return $userSocial ? $userSocial->user : null;
    }

    public function createUser($request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'verified' => false,
            'password' => Hash::make($request->password),
        ])->attachRole('user');

        $this->createUserSocial($user, $request->social_id, $request->service);

        $this->setVerifyToken($user);

        return $user;
    }

    public function sendVerifyMail(User $user)
    {
        $user->notify(new MailEmailVerification);
    }

    public function createUserSocial(User $user, $socialId, $service)
    {
        if ($this->needsToCreateSocial($user, $service)) {
            return $user->socials()->create([
                'social_id' => $socialId,
                'service' => $service
            ]);
        }
    }

    public function needsToCreateVerify(User $user)
    {
        return !$user->verifyUser;
    }

    public function setVerifyToken(User $user)
    {
        if ($this->needsToCreateVerify($user)) {
            $verifyUser = $user->verifyUser()->create([
                'token' => sha1(time())
            ]);
        } else {
            $verifyUser = $user->verifyUser;
            $verifyUser->token = sha1(time());
            $verifyUser->save();
        }

        $this->sendVerifyMail($verifyUser->user);
    }
}
