<?php

namespace App\Http\Middleware;

use App\Models\User;
use App\Models\UserGroup;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckIsAdmin
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
        /** @var User $user */
        $user = Auth::user();
        if ($user &&  $user->group->name === UserGroup::ADMIN_GROUP ) {
            return $next($request);
        }

        return redirect('/');
    }
}
