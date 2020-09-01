<?php


namespace App\Services\Adverts\Handler;


use Illuminate\Http\Request;

class CacheKeyGenerator
{
    const LIST_CACHE_KEY = 'advertList';
    const PAGE_CACHE_KEY = 'homeList';
    const CACHE_TIME = 60*20;

    public function generatePageKey($id)
    {

        return  self::PAGE_CACHE_KEY.'-'.$id;
    }

    public function generatePageAPIKey(int $limit, int $offset)
    {

        return  self::PAGE_CACHE_KEY.$limit.'_'.$offset;
    }

}
