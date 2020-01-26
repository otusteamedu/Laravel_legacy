<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Auth;

/**
 * Можно пользовотелю с данной ролью входить в панель администратора
 *
 * Class AcceptAdminPanel
 * @package App\Http\Middleware
 */
class AcceptAdminPanel
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
        if (!$user->acceptAdminPanel()) {
            throw new AuthenticationException();
        }
        return $next($request);
    }
}
