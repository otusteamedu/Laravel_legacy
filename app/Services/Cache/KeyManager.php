<?php


namespace App\Services\Cache;


use Illuminate\Foundation\Http\FormRequest;

class KeyManager
{
    /**
     * @param array $params
     * @return string
     */
    public function getCategoriesKey(array $params): string
    {
        return $this->getKey(Key::CATEGORIES_PREFIX, $this->generateParamsKeySuffix($params));
    }

    /**
     * @param FormRequest $request
     * @param array|null $keys
     * @return string
     */
    private function generateRequestKeySuffix(FormRequest $request, ?array $keys = null): string
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
