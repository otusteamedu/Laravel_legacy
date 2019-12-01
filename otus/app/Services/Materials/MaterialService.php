<?php

namespace App\Services\Materials;

use App\Models\Material;

use App\Services\Materials\Repositories\CachedMaterialRepositoryInterface;
use App\Services\Materials\Repositories\MaterialsRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class MaterialService {

    private $materialRepository;
    private $cachedMaterialRepository;

    public function __construct(MaterialsRepositoryInterface $materialRepository, CachedMaterialRepositoryInterface $cachedMaterialRepository) {
        $this->materialRepository = $materialRepository;
        $this->cachedMaterialRepository = $cachedMaterialRepository;
    }

    public function findMaterial(int $id): Material {
        return $this->materialRepository->find($id);
    }

    /**
     * @return LengthAwarePaginator
     */
    public function searchMaterials() {
        return $this->cachedMaterialRepository->search();
    }

    /**
     * @param array $data
     * @return Material
     */
    public function storeMaterial(array $data): Material {
        return $this->materialRepository->createFromArray($data);
    }

    /**
     * @param Material $material
     * @param array $data
     */
    public function updateMaterial(Material $material, array $data) {
        $this->materialRepository->updateFromArray($material, $data);
    }

    /**
     * @param array $ids
     */
    public function destroyMaterials(array $ids) {
        $this->materialRepository->destroy($ids);
    }
}
