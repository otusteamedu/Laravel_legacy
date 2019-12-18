<?php

namespace App\Listeners\Cache\Material;

use App\Services\Materials\Repositories\CachedMaterialRepositoryInterface;

class ClearMaterialCache {
    /**
     * @var CachedMaterialRepositoryInterface
     */
    private $cachedMaterialRepository;

    /**
     * ClearMaterialCache constructor.
     * @param CachedMaterialRepositoryInterface $cachedMaterialRepository
     */
    public function __construct(CachedMaterialRepositoryInterface $cachedMaterialRepository) {
        $this->cachedMaterialRepository = $cachedMaterialRepository;
    }

    public function handle() {
        $this->cachedMaterialRepository->clearSearchCache();
    }
}
