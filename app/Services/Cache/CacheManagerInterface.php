<?php
/**
 * @copyright Copyright (c) Archvile <info@0x25.ru>
 * @link https://0x25.ru
 */

namespace App\Services\Cache;


interface CacheManagerInterface
{
    /**
     * @param  string|null  $route
     *
     * @return string
     */
    public function publicCacheKey(?string $route = null) :string;

    /**
     * @param  string|null  $route
     *
     * @return string
     */
    public function authCacheKey(?string $route = null) :string;

    /**
     * @param  string  $key
     *
     * @return bool
     */
    public function clearKey(string $key) :bool;
}