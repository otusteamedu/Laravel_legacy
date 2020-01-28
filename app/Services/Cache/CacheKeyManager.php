<?php


namespace App\Services\Cache;


class CacheKeyManager
{
    public function generateKey()
    {
        return md5('news.list');
    }
}
