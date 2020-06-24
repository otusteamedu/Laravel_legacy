<?php


namespace App\Services\Adverts\Repositories;


class AdvertCacheRepository
{


    const LIST_CACHE_KEY = 'advertList';
    const PAGE_CACHE_KEY = 'homeList';
    const CACHE_TIME = 60*20;

    private $advertRepository;

    public function __construct(AdvertRepositoryInterface $advertRepository)
    {
        $this->advertRepository = $advertRepository;
    }

    public function cachingAdvertList()
    {
        return \Cache::remember(self::LIST_CACHE_KEY, self::CACHE_TIME, function() {
            return $this->advertRepository->list();
        });

    }

    public function cachingPage($qty)
    {

        return \Cache::remember(self:: PAGE_CACHE_KEY, self::CACHE_TIME, function() use($qty){
            return $this->advertRepository->paginateList($qty);
        });

    }

}
