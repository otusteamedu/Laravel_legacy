<?php

namespace App\Http\Controllers\Locales;

use App\Http\Controllers\Controller;
use App\Services\Helpers\Locale\Locale;
use App\Services\Locales\LocaleService;
use App\Services\Users\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class LocaleController extends Controller
{
    /**
     * @var LocaleService
     */
    protected $service;
    /**
     * @var UserService
     */
    protected $userService;

    /**
     * LocaleController constructor.
     * @param LocaleService $service
     * @param UserService $userService
     */
    public function __construct(LocaleService $service, UserService $userService)
    {
        parent::__construct();

        $this->service = $service;
        $this->userService = $userService;
    }

    /**
     * @param string $locale
     * @return RedirectResponse
     */
    public function change(string $locale): RedirectResponse
    {
        $cookie = $this->service->setLocale($locale);

        if ($user = Auth::user()) {
            $this->userService->setUserLocale($user, $locale);
        }

        return redirect()->back()->withCookies([$cookie]);
    }
}
