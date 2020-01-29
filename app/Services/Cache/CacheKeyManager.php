<?php


namespace App\Services\Cache;


class CacheKeyManager
{
    public function generateNewsKey($id = null)
    {
        return md5('news.list'.$id);
    }


}
