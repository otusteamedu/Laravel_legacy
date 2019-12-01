<?php

namespace App\Listeners\Cache\Handbook;

use App\Services\Handbooks\Repositories\CachedHandbookRepositoryInterface;

class ClearHandbookCache {
    /**
     * @var CachedHandbookRepositoryInterface
     */
    private $cachedHandbookRepository;

    /**
     * ClearHandbookCache constructor.
     * @param CachedHandbookRepositoryInterface $cachedHandbookRepository
     */
    public function __construct(CachedHandbookRepositoryInterface $cachedHandbookRepository) {
        $this->cachedHandbookRepository = $cachedHandbookRepository;
    }

    public function handle() {
        $this->cachedHandbookRepository->clearSearchCache();
    }
}
