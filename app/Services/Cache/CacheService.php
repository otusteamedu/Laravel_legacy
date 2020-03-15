<?php

namespace App\Services\Cache;

class CacheService
{
    /** @var string[] */
    public const CACHE_TAGS = [
        'menu' => 'menu',
        'page' => 'page',
        'rubric' => 'rubric',
        'post' => 'post',
        'comment' => 'comment',
        'all' => 'all',
        'lastList' => 'last.list',
        'view' => 'view',
    ];

    /** @var float[]|int[]  */
    public const CACHE_TTL = [
        'menu' => 1 * 60 * 60,
        'lastList' => 1 * 60 * 60,
        'rubric' => 24 * 60 * 60,
        'view' => 7 * 24 * 60 * 60,
        'comment' => 24 * 60 * 60,
    ];

    /**
     * @param $listParams
     * @return string
     */
    public static function makeListName($listParams): string
    {
        return md5(serialize($listParams));
    }

    /**
     * @param string $slug
     * @return string
     */
    public static function makePageName(string $slug): string
    {
        return md5($slug);
    }
}