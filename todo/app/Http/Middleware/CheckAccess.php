<?php

namespace App\Http\Middleware;

use App\Services\AuthService;
use Illuminate\Support\Facades\Auth;
use Closure;

class CheckAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    private $authService;
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }
    public function handle($request, Closure $next)
    {
        $user = Auth::user();
        if(!$user || !$this->authService->checkCurrentUserRouteAccess($user, $request->route()->getName())){
           abort(403);
        }
        return $next($request);
    }
}
