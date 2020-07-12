<?php

namespace App\Http\Middleware;

use App\Services\Locales\LocaleService;
use App\Services\Users\UserService;
use Closure;
use Illuminate\Http\Request;

class Localization
{
    /**
     * @var LocaleService
     */
    private $localeService;
    /**
     * @var UserService
     */
    private $userService;

    /**
     * Localization constructor.
     * @param LocaleService $localeService
     * @param UserService $userService
     */
    public function __construct(LocaleService $localeService, UserService $userService)
    {
        $this->localeService = $localeService;
        $this->userService = $userService;
    }

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!($locale = $this->localeService->getLocale())) {
            $locale = $this->userService->getUserLocale($request->user());
        }
        $cookie = $this->localeService->setLocale($locale);

        return $next($request)->withCookie($cookie);
    }
}
