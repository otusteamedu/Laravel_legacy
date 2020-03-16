<?php
/**
 * Description of RequestLocaleHandler.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Services\Locale\Handlers;


use Illuminate\Http\Request;

class RequestLocaleHandler
{
    private $locales = [
        'en',
        'ru',
    ];

    public function handle($request): void
    {
        $locale = $this->getRequestLocale($request);
        if (!$locale) {
            abort(404);
        }
        \App::setLocale($locale);
        $request->route()->forgetParameter('locale');
    }

    private function getRequestLocale(Request $request): ?string
    {
        $locale = $request->route('locale');
        if (in_array($locale, $this->locales)) {
            return $locale;
        }
        return null;
    }

}
