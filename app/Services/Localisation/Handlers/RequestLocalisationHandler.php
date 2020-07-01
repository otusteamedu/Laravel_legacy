<?php

namespace App\Services\Localisation\Handlers;


use Illuminate\Http\Request;

class RequestLocalisationHandler
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
