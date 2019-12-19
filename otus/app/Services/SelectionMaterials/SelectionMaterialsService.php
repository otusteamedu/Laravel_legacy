<?php

namespace App\Services\SelectionMaterials;

use App\Models\SelectionMaterial;
use App\Services\SelectionMaterials\Repositories\CachedSelectionMaterialRepositoryInterface;
use App\Services\SelectionMaterials\Repositories\SelectionMaterialsRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class SelectionMaterialsService {

    private $selectionMaterialsRepository;
    private $cachedSelectionMaterialRepository;

    public function __construct(SelectionMaterialsRepositoryInterface $selectionMaterialsRepository, CachedSelectionMaterialRepositoryInterface $cachedSelectionMaterialRepository) {
        $this->selectionMaterialsRepository = $selectionMaterialsRepository;
        $this->cachedSelectionMaterialRepository = $cachedSelectionMaterialRepository;
    }

    public function findSelectionMaterial(int $id): SelectionMaterial {
        return $this->selectionMaterialsRepository->find($id);
    }

    /**
     * @return LengthAwarePaginator
     */
    public function searchSelectionMaterials(): LengthAwarePaginator {
        return $this->cachedSelectionMaterialRepository->search();
    }

    /**
     * @param array $data
     * @return SelectionMaterial
     */
    public function storeSelectionMaterial(array $data): SelectionMaterial {
        return $this->selectionMaterialsRepository->createFromArray($data);
    }

    /**
     * @param SelectionMaterial $selectionMaterial
     * @param array $data
     */
    public function updateSelectionMaterial(SelectionMaterial $selectionMaterial, array $data) {
        $this->selectionMaterialsRepository->updateFromArray($selectionMaterial, $data);
    }

    /**
     * @param array $ids
     */
    public function destroySelectionMaterial(array $ids) {
        $this->selectionMaterialsRepository->destroy($ids);
    }
}