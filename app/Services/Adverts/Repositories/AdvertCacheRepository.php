<?php


namespace App\Services\Adverts\Repositories;


class AdvertCacheRepository
{


    const LIST_CACHE_KEY = 'advertList';
    const PAGE_CACHE_KEY = 'homeList';
    const CACHE_TIME = 60*20;

    public $paginateResult;

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

    public function cachingPage($qty)  //TODO вернуть кэш в хоум контроллер, проверить,
    {

        $this->paginateResult = $this->advertRepository->paginateList($qty);

        $cacheKey =  self::PAGE_CACHE_KEY.'-'.$this->paginateResult->links->data->currentPage; //TODO вынести в класс-генератор ключа, генерит ключ под запрос, незабыть в прогреве

        return \Cache::remember($cacheKey, self::CACHE_TIME, function() use($qty){
            return $this->paginateResult;
            //return $this->advertRepository->paginateList($qty);
        });

    }

    public function cachingPageApi(int $limit, int $offset)
    {

        $cacheKey = self::PAGE_CACHE_KEY.$limit.'_'.$offset; //TODO вынести в класс-генератор ключа, генерит ключ под запрос, незабыть в прогреве

        return \Cache::remember($cacheKey, self::CACHE_TIME, function() use($limit, $offset){
            return $this->advertRepository->paginateListApi($limit, $offset);
        });

    }

}
