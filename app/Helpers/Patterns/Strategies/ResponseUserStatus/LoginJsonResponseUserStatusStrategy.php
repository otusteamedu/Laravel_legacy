<?php

namespace App\Helpers\Patterns\Strategies\ResponseUserStatus;

trait LoginJsonResponseUserStatusStrategy
{
    use ResponseUserStatusStrategy;

    public function getNotPublished()
    {
        return response()->json([
            'messages' => [
                'danger' => trans('auth.locked_out')
            ]
        ], 403);
    }

    public function getNotVerified($email)
    {
        return response()->json([
            'messages' => [
                'warning' => trans('auth.activation_code_sent', ['email' => $email])
            ]
        ], 401);
    }

    public function getAllRights($name, $token)
    {
        return response()->json([
            'messages' => [
                'success' => trans('auth.welcome_message', ['name' => $name])
            ],
            'token' => $token
        ], 200);
    }
}
