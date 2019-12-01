<?php

namespace App\Listeners\Cache\Author;

use App\Services\Authors\Repositories\CachedAuthorRepositoryInterface;

class ClearAuthorCache {

    /**
     * @var CachedAuthorRepositoryInterface
     */
    private $cachedAuthorRepository;

    /**
     * ClearAuthorCache constructor.
     * @param CachedAuthorRepositoryInterface $cachedAuthorRepository
     */
    public function __construct(CachedAuthorRepositoryInterface $cachedAuthorRepository) {
        $this->cachedAuthorRepository = $cachedAuthorRepository;
    }

    public function handle() {
        $this->cachedAuthorRepository->clearSearchCache();
    }
}
