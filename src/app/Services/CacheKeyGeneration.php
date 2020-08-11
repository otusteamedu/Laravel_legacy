<?php

namespace App\Services;

/**
 * Генератор ключа для кэша
 * Class CacheKeyGeneration
 * @package App\Services
 */
class CacheKeyGeneration
{

    /**
     * Сгенерировать ключ для кэша
     * @param string $prefix
     * @param $id
     * @return string
     */
    public static function getKey(string $prefix, $id)
    {
        return md5($prefix."_".$id);
    }
}
