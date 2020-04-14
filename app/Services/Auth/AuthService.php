<?php


namespace App\Services\Auth;


use App\Models\User;
use App\Services\Base\Auth\BaseAuthService;
use App\Services\User\Resources\User as UserResource;
use Illuminate\Http\Request;

class AuthService extends BaseAuthService
{
    /**
     * @param Request $request
     * @return array
     */
    public function index(Request $request)
    {
        $user = $request->user();

        if ($user && $user->isActive() && $user->isVerified()) {
            return [
                'data' => new UserResource($request->user())
            ];
        }
//        $this->logout();
    }

    public function logout()
    {
        $this->auth->invalidate();
    }

    /**
     * @param string $token
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function verifyUser(string $token)
    {
        $user = $this->repository->getUserVerify($token);

        if (!$user)
            return redirect(env('CLIENT_BASE_URL')
                . '/login'
                . '?message=' . __('auth.invalid_token')
                . '&status=danger');

        $message = $this->repository->verifyUser($user)
            ? __('auth.email_verified')
            : __('auth.email_already_verified');

        return redirect(env('CLIENT_BASE_URL')
            . '/login'
            . '?message=' . $message
            . '&status=success');
    }

    /**
     * @param User $user
     */
    public function createEmailVerification(User $user)
    {
        $this->repository->setVerifyToken($user);
        $user->sendEmailVerificationNotification();
    }

    /**
     * @param string $email
     * @return array
     */
    public function getMessageByRegistration(string $email): array
    {
        return [
            'message' => __('auth.send_activation_code', ['email' => $email]),
            'status' => 'primary'
        ];
    }
}
