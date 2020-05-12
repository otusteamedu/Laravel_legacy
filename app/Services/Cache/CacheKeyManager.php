<?php
/**
 * Description of CacheKeyManager
 */

namespace App\Services\Cache;


use Illuminate\Http\Request;

class CacheKeyManager
{

    /**
     * @param Request $request
     * @return string
     */
    public function getRequestCountriesKey(Request $request): string
    {
        return $this->getKey(
            Key::CMS_COUNTRIES_PREFIX,
            $this->generateRequestKeySuffix($request)
        );
    }

    /**
     * @param int $country_id
     * @return string
     */
    public function getCountryKey(int $country_id): string
    {
        return $this->getKey(
            Key::CMS_COUNTRY_PREFIX,
            $country_id
        );
    }

    /**
     * @param int $currency_id
     * @return string
     */
    public function getCurrencyKey(int $currency_id): string
    {
        return $this->getKey(
            Key::CMS_CURRENCY_PREFIX,
            $currency_id
        );
    }

    /**
     * @param array $filters
     * @return string
     */
    public function getSearchCountriesKey(array $filters): string
    {
        return $this->getKey(
            Key::CMS_COUNTRIES_PREFIX,
            $this->generateParamsKeySuffix(array_merge(
                [
                    'page' => request()->get('page'),
                ], $filters
            ))
        );
    }

    /**
     * @param array $filters
     * @return string
     */
    public function getSearchIncomesKey(array $filters): string
    {
        return $this->getKey(
            Key::CMS_COUNTRIES_PREFIX,
            $this->generateParamsKeySuffix(array_merge(
                [
                    'page' => request()->get('page'),
                ], $filters
            ))
        );
    }

    /**
     * @param array $filters
     * @return string
     */
    public function getSearchCurrenciesKey(array $filters): string
    {
        return $this->getKey(
            Key::CMS_CURRENCIES_PREFIX,
            $this->generateParamsKeySuffix(array_merge(
                [
                    'page' => request()->get('page'),
                ], $filters
            ))
        );
    }

    /**
     * @param Request $request
     * @param array|null $keys
     * @return string
     */
    private function generateRequestKeySuffix(Request $request, ?array $keys = null): string
    {
        return $this->generateParamsKeySuffix([
            $request->fullUrl(),
            $request->all($keys),
        ]);
    }

    /**
     * @param array $params
     * @return string
     */
    private function generateParamsKeySuffix(array $params): string
    {
        return md5(implode('|', $params));
    }

    /**
     * @param string $prefix
     * @param string|null $suffix
     * @return string
     */
    private function getKey(string $prefix, ?string $suffix = null): string
    {
        if (!$suffix) {
            return $prefix;
        }
        return sprintf('%s|%s', $prefix, $suffix);
    }

}
