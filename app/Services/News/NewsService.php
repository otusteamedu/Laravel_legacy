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

    public function getCachedNews($time = null)
    {
        return $this->cachedNewsRepository->getListNews($time);
    }

    public function getCachedId($id)
    {
        return $this->cachedNewsRepository->getFindId($id);
    }

    public function clearCacheNews()
    {
        Cache::flush();
    }

}
