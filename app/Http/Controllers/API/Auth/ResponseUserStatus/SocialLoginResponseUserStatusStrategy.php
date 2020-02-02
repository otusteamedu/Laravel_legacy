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
            . '&danger=' . trans('auth.locked_out'));
    }

    public function getNotVerified($email)
    {
        return redirect(env('CLIENT_BASE_URL')
            . '/social-callback?'
            . 'origin=login'
            . '&no_verified=true'
            . '&primary=' . trans('auth.send_activation_code', ['email' => $email]));
    }

    public function getAllRights($name, $token)
    {
        return redirect(env('CLIENT_BASE_URL')
            . '/social-callback?'
            . 'origin=login'
            . '&success=' . trans('auth.welcome_message', ['name' => $name])
            . '&token=' . $token);
    }
}
