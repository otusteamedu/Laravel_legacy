<?php

namespace App\Services\Journals\Repositories;

use App\Services\Cache\CacheKeyManager;
use App\Services\Cache\Tag;
use Cache;

class CachedJournalRepository implements CachedJournalRepositoryInterface {

    const CACHE_SEARCH_SECONDS = 3600;

    /** @var JournalsRepositoryInterface */
    private $journalRepository;

    /** @var CacheKeyManager */
    private $cacheKeyManager;

    public function __construct(JournalsRepositoryInterface $journalRepository, CacheKeyManager $cacheKeyManager) {
        $this->journalRepository = $journalRepository;
        $this->cacheKeyManager = $cacheKeyManager;
    }

    public function search(array $filters = [], array $with = []) {
        $key = $this->cacheKeyManager->getSearchJournalsKey($filters);
        $result =  Cache::tags([Tag::JOURNALS])
            ->remember($key, self::CACHE_SEARCH_SECONDS, function () use ($filters, $with) {
                return $this->journalRepository->search($filters, $with);
            });

        return $result;
    }

    public function clearSearchCache() {
        Cache::tags([Tag::JOURNALS])->flush();
    }
}
