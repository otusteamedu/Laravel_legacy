<?php


namespace App\Services\Adverts\Repositories;


use App\Services\Adverts\Handler\CacheKeyGenerator;

class AdvertCacheRepository
{


    const LIST_CACHE_KEY = 'advertList';
    const PAGE_CACHE_KEY = 'homeList';
    const CACHE_TIME = 60*20;

    public $paginateResult;

    private $advertRepository;
    private $cacheKeyGenerator;

    public function __construct(AdvertRepositoryInterface $advertRepository, CacheKeyGenerator $cacheKeyGenerator)
    {
        $this->advertRepository = $advertRepository;
        $this->cacheKeyGenerator = $cacheKeyGenerator;
    }

    public function cachingAdvertList()
    {
        return \Cache::remember(self::LIST_CACHE_KEY, self::CACHE_TIME, function() {
            return $this->advertRepository->list();
        });

    }

    public function cachingPage($qty)
    {

        $this->paginateResult = $this->advertRepository->paginateList($qty);
        $cacheKey = $this->cacheKeyGenerator->generatePageKey($this->paginateResult->currentPage());  //TODO  добавить в прогрев

        return \Cache::remember($cacheKey, self::CACHE_TIME, function() use($qty){
            //return $this->paginateResult;
            return $this->advertRepository->paginateList($qty);
        });

    }

    public function cachingPageApi(int $limit, int $offset)
    {

        $cacheKey = $this->cacheKeyGenerator->generatePageAPIKey($limit, $offset);       //TODO  добавить в прогрев

        return \Cache::remember($cacheKey, self::CACHE_TIME, function() use($limit, $offset){
            return $this->advertRepository->paginateListApi($limit, $offset);
        });

    }

}
