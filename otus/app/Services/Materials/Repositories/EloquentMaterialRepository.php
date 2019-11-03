<?php

namespace App\Services\Materials\Repositories;

use App\Models\Material;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class EloquentMaterialRepository implements MaterialsRepositoryInterface {

    public function find(int $id) {
        return Material::query()->find($id);
    }

    public function search(): LengthAwarePaginator {
        return Material::query()->orderByDesc('created_at')->paginate();
    }

    public function destroy(array $ids) {
        return Material::destroy($ids);
    }

    public function createFromArray(array $data): Material {
        $material = new Material();

        $material->fill($data);
        $material->save();

        foreach ($data['authors_id'] as $id) {
            $material->authors()->attach($id);
        }

        $this->updateFromArray($material, $data);

        return $material;
    }

    public function updateFromArray(Material $material, array $data): Material {
        $material->update($data);
        return $material;
    }
}
