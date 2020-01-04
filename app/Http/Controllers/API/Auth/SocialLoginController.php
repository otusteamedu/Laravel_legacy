<?php

namespace App\Http\Controllers\API\Auth;

use App\Helpers\Patterns\Strategies\ResponseUserStatus\SocialLoginResponseUserStatusStrategy;
use App\Http\Requests\UserSocialRequest;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use App\Repositories\UserSocialRepository;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Tymon\JWTAuth\JWTAuth;

class SocialLoginController extends Controller
{
    use SocialLoginResponseUserStatusStrategy;

    protected $auth,
        $userRepository,
        $userSocialRepository;

    public function __construct(JWTAuth $auth, UserRepository $userRepository, UserSocialRepository $userSocialRepository)
    {
        $this->auth = $auth;
        $this->userRepository = $userRepository;
        $this->userSocialRepository = $userSocialRepository;
        $this->middleware('social');
    }

    public function redirect($service)
    {
        return Socialite::driver($service)->stateless()->redirect();
    }

    public function registered($service, UserSocialRequest $request)
    {
        $user = $this->userRepository->createUserWithSocials($request);

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
            return redirect(env('CLIENT_BASE_URL') . '/social-callback?'
                . 'danger=' .trans('auth.unable_using_service', ['service' => Str::title($service)])
                . '&origin=login');
        }

        if ($user = $this->userSocialRepository->getUserBySocial($serviceUser->getId())) {
            return $this->getUserStatusResponse($user, $this->auth->fromUser($user), $this->userRepository);
        }
        if ($user = $this->userRepository->getUserByEmail($serviceUser->getEmail())) {
            $this->userRepository->createUserSocial($user, $serviceUser->getId(), $service);
            return $this->getUserStatusResponse($user, $this->auth->fromUser($user), $this->userRepository);
        }

        return redirect(env('CLIENT_BASE_URL') . '/social-callback?'
            . 'name=' . ($serviceUser->getName() ? $serviceUser->getName() : '')
            . '&email=' . ($serviceUser->getEmail() ? $serviceUser->getEmail() : '')
            . '&social_id=' . $serviceUser->getId()
            . '&service=' . $service
        );
    }
}
