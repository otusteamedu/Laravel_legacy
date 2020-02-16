<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;

class UserVerified
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
        if (! $request->user()) {
            $credentials = $request->only('email', 'password');
            auth()->attempt($credentials);
        }

        /** @var User $user */
        $user = auth()->user();

        if ($user->verified) {
            return $next($request);
        }

        $user->sendEmailVerificationNotification();

        return response()->json([
            'message' => __('auth.send_activation_code', ['email' => $user->email]),
            'status' => 'primary'
        ], 401);
    }
}
