<?php

namespace App\Listeners\Cache\SelectionMaterial;

use App\Services\SelectionMaterials\Repositories\CachedSelectionMaterialRepositoryInterface;

class ClearSelectionMaterialCache {
    /**
     * @var CachedSelectionMaterialRepositoryInterface
     */
    private $cachedSelectionMaterialRepository;

    /**
     * ClearSelectionMaterialCache constructor.
     * @param CachedSelectionMaterialRepositoryInterface $cachedSelectionMaterialRepository
     */
    public function __construct(CachedSelectionMaterialRepositoryInterface $cachedSelectionMaterialRepository) {
        $this->cachedSelectionMaterialRepository = $cachedSelectionMaterialRepository;
    }

    public function handle() {
        $this->cachedSelectionMaterialRepository->clearSearchCache();
    }
}
