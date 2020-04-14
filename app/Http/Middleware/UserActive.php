<?php

namespace App\Http\Middleware;

use Closure;


class UserActive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = $request->user();

        if (! $user->publish) {
            return response()->json([
                'message' => __('auth.locked_out'),
                'status' => 'danger'
            ], 403);
        }

        if (! $user->verified) {
            $user->sendEmailVerificationNotification();

            return response()->json([
                'message' => __('auth.send_activation_code', ['email' => $user->email]),
                'status' => 'primary'
            ], 401);
        }

        return $next($request);
    }
}
