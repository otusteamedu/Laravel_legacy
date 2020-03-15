<?php

namespace App\Http\Middleware\Portal\Menu;

use App\Services\Portal\Menu\PageMenuService;
use Closure;
use Illuminate\Http\Request;

/**
 * Class PageMenu
 * @package App\Http\Middleware\Portal\Menu
 */
class PageMenu
{
    /** @var PageMenuService $pageMenuService */
    protected $pageMenuService;

    /**
     * PageMenu constructor.
     * @param PageMenuService $pageMenuService
     */
    public function __construct(PageMenuService $pageMenuService)
    {
        $this->pageMenuService = $pageMenuService;
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
        $this->pageMenuService->createMenu();
        return $next($request);
    }
}
