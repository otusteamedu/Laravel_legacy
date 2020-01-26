<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckAdmin
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
        // пользователь = админ ?
        $is_admin = false;
        if(Auth::check())
        {
            $user = auth()->user();
            $is_admin = $user->level == User::LEVEL_ADMIN ? true:false;
        }
        if(!$is_admin)
        {
            abort(403);
        }
        return $next($request);
    }
}
