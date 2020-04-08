<?php

namespace App\Services\Locales;

use App\Services\Languages\LanguagesService;
use App\Services\Locales\Resolvers\AvailableLocaleListResolver;


class LocalesService
{
    private const LOCALE_COOKIE_NAME = 'locale';
    private const LOCALE_DEFAULT_VALUE = 'ru';

    private $availableLocaleListResolver;
    private $languagesService;

    public function __construct(AvailableLocaleListResolver $availableLocaleListResolver, LanguagesService $languagesService)
    {
        $this->availableLocaleListResolver = $availableLocaleListResolver;
        $this->languagesService = $languagesService;
    }

    public function getAllLocaleList() { // @ToDo: изменить на коллекции
        $localeList = [];

        foreach ($this->languagesService->getAllLanguagePaginator() as $language) {
            $localeList[] = [
                'code' => $language->code,
                'name' => $language->name,
            ];
        }

        return $localeList;
    }

    public function getCurrentLocalePath(): string {
        $locale = $this->getUrlLocale();

        if (empty($locale)) {
            $locale = $this->getDefaultLocale();
        }

        if ($locale === $this->getDefaultLocale()) {
            $locale = '';
        }

        return $locale;
    }

    public function getCurrentLocale(): string {
        $locale = $this->getUserLocale();

        if (empty($locale)) {
            $locale = $this->getUrlLocale();
        }

        if (empty($locale)) {
            $locale = $this->getDefaultLocale();
        }

        return $locale;
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|null
     */
    public function getRedirectIfNeed() {
        if (!empty($this->getUserLocale())) {
            if (($this->getUserLocale() !== $this->getUrlLocale()) && $this->getUserLocale() !== $this->getDefaultLocale()) {
                return redirect('/' . $this->getCurrentLocale());
            }

            if (!empty($this->getUrlLocale()) && $this->getUserLocale() === $this->getDefaultLocale()) {
                return redirect('/');
            }
        }

        return null;
    }

    public function isDefaultLocaleSet() {
        return $this->getCurrentLocalePath() === $this->getDefaultLocale();
    }

    public function getUserLocale(): string {
        $locale = \Cookie::get(self::LOCALE_COOKIE_NAME);
        $locale = $this->filterLocale($locale ?? '');

        return $locale;
    }

    public function setUserLocale(string $locale = ''): void {
        $locale = $this->filterLocale($locale ?? '');

        if (empty($locale)) {
            $locale = self::LOCALE_DEFAULT_VALUE;
        }

        \Cookie::queue(\Cookie::forever(self::LOCALE_COOKIE_NAME, $locale));
    }

    public function getDefaultLocale(): string {
        return self::LOCALE_DEFAULT_VALUE;
    }

    private function getUrlLocale(): string {
        /*$request = request();
        $locale = $request->route(self::LOCALE_URL_PARAM_NAME); @ToDO: спросить, пчоему тут недоступна локаль*/
        $locale = (request()->segment(1, ''));
        $locale = $this->filterLocale($locale ?? '');

        return $locale;
    }

    private function filterLocale(string $locale = ''): string {
        if (empty($locale)) {
            return $locale;
        }

        $availableLocaleList = $this->availableLocaleListResolver->resolve();

        if (!in_array($locale, $availableLocaleList)) {
            $locale = '';
        }

        return $locale;
    }
}
