<?php

namespace App\Services\Localize\Handlers;

use App\Services\Locale\Locale;
use Illuminate\Http\Request;

/**
 * Установка локализации
 * Class BusinessCreateHandler
 * @package App\Services\Businesses\Handlers
 */
class LocalizeSetHandler
{

    /**
     * @var Request
     */
    private $request;

    public function __construct(
        Request $request
    )
    {
        $this->request = $request;
    }

    /**
     * @param string $locale
     * @return bool
     */
    public function handle(string $locale): bool
    {
        if (!Locale::isSupported($locale))
            return false;

        $this->request->session()->put(Locale::LOCALE_SESSION_KEY, $locale);
        return true;
    }
}
