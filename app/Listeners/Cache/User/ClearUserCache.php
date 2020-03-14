<?php

namespace App\Listeners\Cache\User;

use App\Services\Cache\Repositories\CacheRepositoryInterface;

class ClearUserCache
{
    /** @var CacheRepositoryInterface */
    private $cacheRepository;

    /**
     * ClearUserCache constructor.
     * @param CacheRepositoryInterface $cacheRepository
     */
    public function __construct(CacheRepositoryInterface $cacheRepository)
    {
        $this->cacheRepository = $cacheRepository;
    }

    /**
     *
     */
    public function handle()
    {
        $this->cacheRepository->clearUserCache();
    }


}
