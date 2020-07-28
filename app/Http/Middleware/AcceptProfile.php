<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Auth\AuthenticationException;


/**
 * Можно пользовотелю с данной ролью входить в личный кабинет
 *
 * Class AcceptProfile
 * @package App\Http\Middleware
 */
class AcceptProfile
{

    /**
     * @param $request
     * @param Closure $next
     * @return mixed
     * @throws AuthenticationException
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user();
        if (!$user->acceptProfile()) {
            throw new AuthenticationException();
        }
        return $next($request);
    }
}
