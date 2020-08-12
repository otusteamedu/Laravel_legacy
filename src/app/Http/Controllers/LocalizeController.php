<?php

namespace App\Http\Controllers;

use App\Services\Localize\LocalizeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

/**
 * Работа с локализацией
 * Class LocalizeController
 * @package App\Http\Controllers
 */
class LocalizeController extends Controller
{
    /**
     * @var LocalizeService
     */
    private $service;

    /**
     * Create a new controller instance.
     *
     * @param LocalizeService $service
     */
    public function __construct(
        LocalizeService $service
    )
    {
        $this->service = $service;
    }

    /**
     * Установить локализацию
     * @param string $locale
     * @return \Illuminate\Http\RedirectResponse
     */
    public function setLocale(string $locale)
    {
        $this->service->set($locale);
        return Redirect::back();
    }
}
