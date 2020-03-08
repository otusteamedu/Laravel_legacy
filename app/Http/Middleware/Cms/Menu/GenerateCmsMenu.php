<?php

namespace App\Http\Middleware\Cms\Menu;

use App\Services\Cms\Menu\CmsMenuService;
use Closure;

/**
 * Class GenerateCmsMenu
 * @package App\Http\Middleware\Cms\Menu
 */
class GenerateCmsMenu
{
    /** @var CmsMenuService  */
    protected $cmsMenuService;

    /**
     * GenerateCmsMenu constructor.
     * @param CmsMenuService $cmsMenu
     */
    public function __construct(CmsMenuService $cmsMenuService)
    {
        $this->cmsMenuService = $cmsMenuService;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $this->cmsMenuService->createMenu();
        return $next($request);
    }
}
