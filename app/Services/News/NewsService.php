<?php


namespace App\Services\News;


use App\Services\News\Repositories\CachedNewsRepository;
use Cache;

class NewsService
{
    private $cachedNewsRepository;

    public function __construct(CachedNewsRepository $cachedNewsRepository)
    {
        $this->cachedNewsRepository = $cachedNewsRepository;
    }

    public function getCachedNews()
    {
        return $this->cachedNewsRepository->getListNews();
    }

    public function clearCacheNews()
    {
        Cache::flush();
    }

}
