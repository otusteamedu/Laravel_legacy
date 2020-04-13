<?php

namespace App\Http\Middleware;

use App\Services\BaseService;
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
    private $baseService;
    public function __construct(BaseService $baseService)
    {
        $this->baseService = $baseService;
    }
    public function handle($request, Closure $next)
    {
        $user = Auth::user();
        if($user)
            $this->baseService->checkCurrentUserRouteAccess($user, $request->route()->getName());
        else {
            abort(403);
        }

        return $next($request);
    }
}
