<?php

namespace App\Services\Locale\Handlers;

use App\Services\Locale\Data\LocaleData;
use Illuminate\Http\Request;

/**
 * Class RequestLocaleHandler
 * Установка локализации
 * @package App\Services\Locale\Handlers
 */
class RequestLocaleHandler
{
    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function handle(Request $request)
    {
        $locale = $this->getRequestLocale($request);
        if ($locale) {
            $back = str_replace($locale . '/', '', $request->getRequestUri());
            return redirect($back)->cookie('locale', $locale, 365 * 24 * 60, '/');
        }
        return null;
    }

    /**
     * Получить переданную локаль
     * @param Request $request
     *
     * @return string|null
     */
    private function getRequestLocale(Request $request): ?string
    {
        $uri = $request->getRequestUri();
        $uriArray = explode('/', $uri);
        unset($uriArray[0]);
        $locale = current($uriArray);
        if (in_array($locale, LocaleData::LOCALES)) {
            return $locale;
        }
        return null;
    }
}
