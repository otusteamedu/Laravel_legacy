<?php

namespace App\Services\SelectionMaterials\Repositories;

interface CachedSelectionMaterialRepositoryInterface {

    public function search(array $filters = [], array $with = []);
    public function clearSearchCache();

}
