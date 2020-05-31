<?php


namespace App\Services\Cache;


use Illuminate\Http\Request;

class CacheKeyManager
{

    public function getRequestFiltersKey(Request $request): string
    {
        return $this->getKey(
            Key::CMS_FILTERS_PREFIX,
            $this->generateRequestKeySuffix($request)
        );
    }


    public function getFilterKey( int $filter_id) : string
    {
        return $this->getKey(
            Key::CMS_FILTER_PREFIX,
            $filter_id
        );
    }

    /**
     * @param array $filters // it's search filter not entity Filter
     * @return string
     */
    public function getSearchFiltersKey(array $filters) : string
    {
        return $this->getKey(
            Key::CMS_FILTERS_PREFIX,
            $this->generateParamsKeySuffix(array_merge(
                [
                    'page' => request()->get('page'),
                ], $filters
            ))
        );
    }




    // ############## Common functions ####################
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
