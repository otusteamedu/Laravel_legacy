<?php


namespace App\Services\Constructions\Repositories;


use Cache;
use App\Repository\Cache\CacheTimeRepositoryInterface;
use App\Repository\Cache\CacheKeyRepositoryInterface;
use App\Repository\Cache\CacheTagRepositoryInterface;


class CachedConstructionRepository implements ConstructionRepositoryInterface, CachedConstructionRepositoryInterface
{

    /** @var ConstructionRepositoryInterface */
    private $constructionRepository;

    /** @var CacheTimeRepositoryInterface */
    private $cacheTimeRepository;

    /** @var CacheKeyRepositoryInterface */
    private $cacheKeyRepository;


    /** @var CacheTagRepositoryInterface */
    private $cacheTagRepository;

    public function __construct(
        ConstructionRepositoryInterface $constructionRepository,
        CacheTimeRepositoryInterface $cacheTimeRepository,
        CacheKeyRepositoryInterface $cacheKeyRepository,
        CacheTagRepositoryInterface $cacheTagRepository
    )
    {
        $this->constructionRepository = $constructionRepository;
        $this->cacheTimeRepository = $cacheTimeRepository;
        $this->cacheKeyRepository = $cacheKeyRepository;
        $this->cacheTagRepository = $cacheTagRepository;
    }

    public function getAllConstruction()
    {

        return Cache::tags([$this->cacheTagRepository->getConstructionTag()])
            ->remember($this->cacheKeyRepository->getConstructionKeyPrefix(), $this->cacheTimeRepository->getCacheConstructionSecond(), function () {
                return $this->constructionRepository->getAllConstruction();
            });

    }

    public function clearConstructionCache()
    {
        return Cache::tags([$this->cacheTagRepository->getConstructionTag()])->flush();

    }
}
