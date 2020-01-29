<?php


namespace App\Helpers\Patterns\Strategies\ResponseUserStatus;


trait ResponseUserStatusStrategy
{
    /**
     * Determines which message to return to the user.
     *
     * @param mixed $user
     * @param string $token
     * @param \App\Repositories\UserRepository $userRepository
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function getUserStatusResponse($user, $token)
    {
        if (!$user->isActive()) {

            return $this->getLockedOut();

        } else if (!$user->isVerified()) {

            $this->authService->createEmailVerification($user);

            return $this->getNotVerified($user->email);
        }

        return $this->getAllRights($user->name, $token);
    }

    /**
     * Notifies that the user is blocked.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    abstract public function getLockedOut();

    /**
     * Notifies that the user is not verified.
     *
     * @param string $email
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    abstract public function getNotVerified($email);

    /**
     * Notifies that the user is auth.
     *
     * @params string $email
     * @param string $token
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    abstract public function getAllRights($name, $token);
}
