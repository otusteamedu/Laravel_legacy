<?php declare(strict_types=1);


namespace App\Services\User;


use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserValidationBuilder
{
    /**
     * @var User|null
     */
    private User $user;

    /**
     * @var JsonResponse|null
     */
    private $statusResponse = null;

    /**
     * @var bool
     */
    private bool $isValid = true;

    /**
     * @param Request $request
     * @return UserValidationBuilder|bool
     */
    public function isAuth(Request $request)
    {
        $credentials = $request->only('email', 'password');

        auth()->attempt($credentials);

        $this->user = $request->user();

        return $this->user
            ? $this->handleSuccess()
            : $this->handleFailAuthResponse();
    }

    /**
     * @return UserValidationBuilder|bool
     */
    public function isActive()
    {
        if (! $this->isValid) {
            return $this;
        }

        return $this->user->publish
            ? $this->handleSuccess()
            : $this->handleFailActiveResponse();
    }

    /**
     * @return UserValidationBuilder|bool
     */
    public function isVerified()
    {
        if (! $this->isValid) {
            return $this;
        }

        return $this->user->verified
            ? $this->handleSuccess()
            : $this->handleFailVerifiedResponse();
    }

    /**
     * @return UserValidationBuilder
     */
    private function handleFailAuthResponse(): UserValidationBuilder
    {
        $this->statusResponse = response()->json([
            'message' => __('auth.wrong_login_pass'),
            'status' => 'danger'
        ], 401);

        return $this->handleFail();
    }

    /**
     * @return UserValidationBuilder
     */
    private function handleFailActiveResponse(): UserValidationBuilder
    {
        $this->statusResponse = response()->json([
            'message' => __('auth.locked_out'),
            'status' => 'danger'
        ], 403);

        return $this->handleFail();
    }

    /**
     * @return UserValidationBuilder
     */
    private function handleFailVerifiedResponse(): UserValidationBuilder
    {
        $this->user->sendEmailVerificationNotification();

        $this->statusResponse = response()->json([
            'message' => __('auth.send_activation_code', ['email' => $this->user->email]),
            'status' => 'warning'
        ], 401);

        return $this->handleFail();
    }

    /**
     * @return UserValidationBuilder
     */
    private function handleSuccess(): UserValidationBuilder
    {
        $this->isValid = true;

        return $this;
    }

    /**
     * @return UserValidationBuilder
     */
    private function handleFail(): UserValidationBuilder
    {
        $this->isValid = false;

        return $this;
    }

    /**
     * @return bool
     */
    public function isValid(): bool
    {
        return $this->isValid;
    }

    /**
     * @return JsonResponse|null
     */
    public function getStatus()
    {
        return $this->statusResponse;
    }
}
