<?php

namespace App\Services\Localize\Repositories;

use App\Services\Locale\Locale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class SessionLocalizeRepository implements LocalizeRepositoryInterface
{
    /**
     * @var Request
     */
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Сохранить локаль
     * @param string $locale
     * @return mixed
     */
    public function set(string $locale): bool
    {
        $this->request->session()->put(Locale::LOCALE_SESSION_KEY, $locale);
        return true;
    }

    /**
     * Получить локаль
     * @return string
     */
    public function get(): string
    {
        return $this->request->session()->get(Locale::LOCALE_SESSION_KEY, App::getLocale());
    }

}
