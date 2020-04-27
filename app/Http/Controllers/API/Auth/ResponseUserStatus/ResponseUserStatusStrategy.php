<?php


namespace App\Http\Controllers\API\Auth\ResponseUserStatus;


trait ResponseUserStatusStrategy
{
    /**
     * Determines which message to return to the user.
     *
     * @param mixed $user
     * @param string $token
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function getUserStatusResponse($user, $token)
    {
        if (!$user->isActive()) {
            return $this->getLockedOut();

        } else if (!$user->isConfirmed()) {
            $this->authService->createEmailConfirmation($user, $user->email);

            return $this->getNotConfirmed($user->email);
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
    abstract public function getNotConfirmed($email);

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
