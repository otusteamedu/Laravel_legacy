<?php

namespace App\Http\Middleware\Portal\Menu;

use App\Services\Portal\Menu\UserMenuService;
use Closure;
use Illuminate\Http\Request;

class UserMenu
{
    /** @var UserMenuService  */
    protected $userMenuService;

    /**
     * UserMenu constructor.
     * @param UserMenuService $userMenuService
     */
    public function __construct(UserMenuService $userMenuService)
    {
        $this->userMenuService = $userMenuService;
    }

    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $this->userMenuService->createMenu();
        return $next($request);
    }
}
