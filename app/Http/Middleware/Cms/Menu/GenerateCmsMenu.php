<?php

namespace App\Http\Middleware\Cms\Menu;

use App\Services\Cms\Menu\CmsMenu;
use Closure;

class GenerateCmsMenu
{
    protected $cmsMenu;

    /**
     * GenerateCmsMenu constructor.
     * @param CmsMenu $cmsMenu
     */
    public function __construct(CmsMenu $cmsMenu)
    {
        $this->cmsMenu = $cmsMenu;
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
        $this->cmsMenu->createMenu();
        return $next($request);
    }
}
