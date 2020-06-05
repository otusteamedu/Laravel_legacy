<?php


namespace App\Services\Cache\Handlers;


use App\Services\Filters\Repositories\CachedFilterRepositoryInterface;

class CacheWarmupHandler
{

    /**
     * @var CachedFilterRepositoryInterface
     */
    private CachedFilterRepositoryInterface $cachedFilterRepository;

    public function __construct(CachedFilterRepositoryInterface $cachedFilterRepository)
    {

        $this->cachedFilterRepository = $cachedFilterRepository;
    }


    public function handler(array $model_list)
    {
        // Simple realisation, use each CacheRepository
        if (in_array('Filter', $model_list)) {
            $this->cachedFilterRepository->warmup();
        }


        if (in_array('Model_name', $model_list)) {
//            $this->cachedModel_nameRepository->warmup();
        }
    }


}
