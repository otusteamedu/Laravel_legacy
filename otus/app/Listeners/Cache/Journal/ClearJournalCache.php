<?php

namespace App\Listeners\Cache\Journal;

use App\Services\Journals\Repositories\CachedJournalRepositoryInterface;

class ClearJournalCache {
    /**
     * @var CachedJournalRepositoryInterface
     */
    private $cachedJournalRepository;

    /**
     * ClearJournalCache constructor.
     * @param CachedJournalRepositoryInterface $cachedJournalRepository
     */
    public function __construct(CachedJournalRepositoryInterface $cachedJournalRepository) {
        $this->cachedJournalRepository = $cachedJournalRepository;
    }

    public function handle() {
        $this->cachedJournalRepository->clearSearchCache();
    }
}
