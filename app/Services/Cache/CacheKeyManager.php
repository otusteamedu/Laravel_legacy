<?php
/**
 * Description of CacheKeyManagerhp
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
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