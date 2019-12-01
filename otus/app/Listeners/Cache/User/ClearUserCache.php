<?php

namespace App\Listeners\Cache\User;

use App\Services\Users\Repositories\CachedUserRepositoryInterface;

class ClearUserCache {
    /**
     * @var CachedUserRepositoryInterface
     */
    private $cachedUserRepository;

    /**
     * ClearUserCache constructor.
     * @param CachedUserRepositoryInterface $cachedUserRepository
     */
    public function __construct(CachedUserRepositoryInterface $cachedUserRepository) {
        $this->cachedUserRepository = $cachedUserRepository;
    }

    public function handle() {
        $this->cachedUserRepository->clearSearchCache();
    }
}
