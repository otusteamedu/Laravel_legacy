<?php

namespace App\Http\Middleware\Portal\Menu;

use App\Services\Portal\Menu\RubricMenuService;
use Closure;
use Illuminate\Http\Request;

class RubricMenu
{
    /** @var RubricMenuService $rubricMenuService */
    protected $rubricMenuService;

    /**
     * RubricMenu constructor.
     * @param RubricMenuService $rubricMenuService
     */
    public function __construct(RubricMenuService $rubricMenuService)
    {
        $this->rubricMenuService = $rubricMenuService;
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
        $this->rubricMenuService->createMenu();

        return $next($request);
    }
}
