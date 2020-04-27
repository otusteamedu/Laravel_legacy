<?php

namespace App\Http\Controllers\API\Auth\ResponseUserStatus;

trait SocialLoginResponseUserStatusStrategy
{
    use ResponseUserStatusStrategy;

    public function getLockedOut()
    {
        return redirect(env('CLIENT_BASE_URL')
            . '/social-callback?'
            . 'origin=login'
            . '&no_verified=true'
            . '&status=danger'
            . '&message=' . trans('auth.locked_out'));
    }

    public function getNotConfirmed($email)
    {
        return redirect(env('CLIENT_BASE_URL')
            . '/social-callback?'
            . 'origin=login'
            . '&no_verified=true'
            . '&status=primary'
            . '&message=' . trans('auth.send_activation_code', ['email' => $email]));
    }

    public function getAllRights($name, $token)
    {
        return redirect(env('CLIENT_BASE_URL')
            . '/social-callback?'
            . 'origin=login'
            . '&status=success'
            . '&message=' . trans('auth.welcome_message', ['name' => $name])
            . '&token=' . $token);
    }
}
