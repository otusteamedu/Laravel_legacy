<?php

namespace App\Http\Middleware;

use App\Models\Role;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAuthUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            $role = Auth::user()->role->type;
            switch ($role) {
                case Role::LEVEL_ROOT:
                    return $next($request);
                break;
                case Role::LEVEL_ADMIN:
                    return $next($request);
                break;
                case Role::LEVEL_USER:
                    return redirect(route('index'));
                break;
                default:
                    return redirect(route('index'));
                break;
            }
       }
       return $next($request);
    }
}
