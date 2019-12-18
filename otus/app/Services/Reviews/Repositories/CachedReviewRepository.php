<?php

namespace App\Services\Reviews\Repositories;

use App\Services\Cache\CacheKeyManager;
use App\Services\Cache\Tag;
use Cache;

class CachedReviewRepository implements CachedReviewRepositoryInterface {

    const CACHE_SEARCH_SECONDS = 3600;

    /** @var ReviewsRepositoryInterface */
    private $reviewRepository;

    /** @var CacheKeyManager */
    private $cacheKeyManager;

    public function __construct(ReviewsRepositoryInterface $reviewRepository, CacheKeyManager $cacheKeyManager) {
        $this->reviewRepository = $reviewRepository;
        $this->cacheKeyManager = $cacheKeyManager;
    }

    public function search(array $filters = [], array $with = []) {
        $key = $this->cacheKeyManager->getSearchReviewsKey($filters);
        $result =  Cache::tags([Tag::REVIEWS])
            ->remember($key, self::CACHE_SEARCH_SECONDS, function () use ($filters, $with) {
                return $this->reviewRepository->search($filters, $with);
            });

        return $result;
    }

    public function clearSearchCache() {
        Cache::tags([Tag::REVIEWS])->flush();
    }
}
