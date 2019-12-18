<?php

namespace App\Listeners\Cache\Review;

use App\Services\Reviews\Repositories\CachedReviewRepositoryInterface;

class ClearReviewCache {
    /**
     * @var CachedReviewRepositoryInterface
     */
    private $cachedReviewRepository;

    /**
     * ClearReviewCache constructor.
     * @param CachedReviewRepositoryInterface $cachedReviewRepository
     */
    public function __construct(CachedReviewRepositoryInterface $cachedReviewRepository) {
        $this->cachedReviewRepository = $cachedReviewRepository;
    }

    public function handle() {
        $this->cachedReviewRepository->clearSearchCache();
    }
}
