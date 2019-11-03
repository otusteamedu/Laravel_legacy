<?php

namespace App\Services\Materials;

use App\Models\Material;

use App\Services\Materials\Repositories\MaterialsRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class MaterialService {

    private $materialRepository;

    public function __construct(MaterialsRepositoryInterface $materialRepository) {
        $this->materialRepository = $materialRepository;
    }

    public function findMaterial(int $id): Material {
        return $this->materialRepository->find($id);
    }

    /**
     * @return LengthAwarePaginator
     */
    public function searchMaterials() {
        return $this->materialRepository->search();
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

        $relatedAuthors = $material->authors()->allRelatedIds()->all();

        foreach ($relatedAuthors as $id) {
            $material->authors()->detach($id);
        }

        foreach ($data['authors_id'] as $id) {
            $material->authors()->attach($id);
        }

        $this->materialRepository->updateFromArray($material, $data);
    }

    /**
     * @param array $ids
     */
    public function destroyMaterials(array $ids) {
        $this->materialRepository->destroy($ids);
    }
}
