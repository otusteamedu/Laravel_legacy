<?php

namespace App\Http\Controllers\API\Auth;

use App\Helpers\Patterns\Strategies\ResponseUserStatus\SocialLoginResponseUserStatusStrategy;
use App\Http\Controllers\API\Auth\Base\BaseLoginController;
use App\Http\Controllers\API\Cms\User\Requests\UserSocialRequest;
use App\Models\User;
use App\Services\Auth\AuthService;
use App\Services\User\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Tymon\JWTAuth\JWTAuth;

class SocialLoginController extends BaseLoginController
{
    use SocialLoginResponseUserStatusStrategy;

    /**
     * SocialLoginController constructor.
     * @param JWTAuth $auth
     * @param AuthService $authService
     * @param UserService $userService
     */
    public function __construct(
        JWTAuth $auth,
        AuthService $authService,
        UserService $userService
    )
    {
        parent::__construct($auth, $authService, $userService);
        $this->middleware('social');
    }

    /**
     * @param $service
     * @return mixed
     */
    public function redirect($service)
    {
        return Socialite::driver($service)->stateless()->redirect();
    }

    /**
     * @param $service
     * @param UserSocialRequest $request
     * @return JsonResponse
     */
    public function registered($service, UserSocialRequest $request): JsonResponse
    {
        /** @var User $user */
        $user = $this->userService->storeWithSocial($request, $service);

        $this->authService->createEmailVerification($user);

        return response()->json($this->authService->getMessageByRegistration($user->email), 200);
    }

    /**
     * @param $service
     * @return JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function callback($service)
    {
        try {
            $serviceUser = Socialite::driver($service)->stateless()->user();

        } catch (\Exception $e) {

            return redirect(env('CLIENT_BASE_URL') . '/social-callback?'
                . 'danger=' .trans('auth.unable_using_service', ['service' => Str::title($service)])
                . '&origin=login');
        }

        if ($user = $this->userService->getUserBySocialId($serviceUser->getId()))
            return $this->getStatusResponse($user);

        if ($user = $this->userService->getUserByEmail($serviceUser->getEmail())) {
            $this->userService->storeUserSocial($user, $serviceUser->getId(), $service);

            return $this->getStatusResponse($user);
        }

        return redirect(env('CLIENT_BASE_URL') . '/social-callback?'
            . 'name=' . ($serviceUser->getName() ? $serviceUser->getName() : '')
            . '&email=' . ($serviceUser->getEmail() ? $serviceUser->getEmail() : '')
            . '&social_id=' . $serviceUser->getId()
            . '&service=' . $service
        );
    }

    /**
     * @param User $user
     * @return JsonResponse|\Illuminate\Http\RedirectResponse
     */
    private function getStatusResponse(User $user)
    {
        return $this->getUserStatusResponse($user, $this->auth->fromUser($user));
    }
}
