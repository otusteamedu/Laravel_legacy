<?php

namespace App\Helpers\Cache;

use Illuminate\Http\Request;

class CacheKeyManager{

    const DEFAULT_TIME  = 600;
    
    /**
     * @param Request $request
     * @param array|null $keys
     * @return string
     */
    protected function generateRequestKeySuffix(Request $request, ?array $keys = null): string
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
    protected function generateParamsKeySuffix(array $params): string
    {
        return md5(implode('|', $params));
    }

    /**
     * @param string $prefix
     * @param string|null $suffix
     * @return string
     */
    protected function getKey(string $prefix, ?string $suffix = null): string
    {
        if (!$suffix) {
            return $prefix;
        }
        return sprintf('%s|%s', $prefix, $suffix);
    }


    /**
     * Формирование ключа для пагинации
     *
     * @param string $modelPrefix
     * @return string
     */
    public function getPaginateKey(string $modelPrefix): string
    {
        $key = $this->getKey(
            $modelPrefix,
            $this->generateParamsKeySuffix(
                ['page'=>request()->get('page')]
            )
        );

        return $key;
    }

    /**
     * Формирование ключа для списка всех записей.
     *
     * @param string $modelPrefix
     * @return string
     */
    public function getListKey(string $modelPrefix): string
    {
        $key = $this->getKey(
            $modelPrefix
        );

        return $key;
    }

}
