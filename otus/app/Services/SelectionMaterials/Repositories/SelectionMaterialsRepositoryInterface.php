<?php

namespace App\Services\SelectionMaterials\Repositories;

use App\Models\SelectionMaterial;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface SelectionMaterialsRepositoryInterface {

    public function find(int $id);

    public function search(): LengthAwarePaginator;

    public function destroy(array $ids);

    public function createFromArray(array $data): SelectionMaterial;

    public function updateFromArray(SelectionMaterial $selectionMaterial, array $data):SelectionMaterial;
}
