<?php

namespace App\Listeners\Cache\Compilation;

use App\Services\Compilations\Repositories\CachedCompilationRepositoryInterface;

class ClearCompilationCache {
    /**
     * @var CachedCompilationRepositoryInterface
     */
    private $cachedCompilationRepository;

    /**
     * ClearCompilationCache constructor.
     * @param CachedCompilationRepositoryInterface $cachedCompilationRepository
     */
    public function __construct(CachedCompilationRepositoryInterface $cachedCompilationRepository) {
        $this->cachedCompilationRepository = $cachedCompilationRepository;
    }

    public function handle() {
        $this->cachedCompilationRepository->clearSearchCache();
    }
}
