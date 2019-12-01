<?php

namespace App\Listeners\Cache\Category;

use App\Services\Categories\Repositories\CachedCategoryRepositoryInterface;

class ClearCategoryCache {

    /**
     * @var CachedCategoryRepositoryInterface
     */
    private $cachedCategoryRepository;

    /**
     * ClearCategoryCache constructor.
     * @param CachedCategoryRepositoryInterface $cachedCategoryRepository
     */
    public function __construct(CachedCategoryRepositoryInterface $cachedCategoryRepository) {
        $this->cachedCategoryRepository = $cachedCategoryRepository;
    }

    public function handle() {
        $this->cachedCategoryRepository->clearSearchCache();
    }
}
