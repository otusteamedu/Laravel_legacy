<?php

namespace App\Services\SelectionMaterials\Repositories;

use App\Models\SelectionMaterial;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class SelectionMaterialsRepository {

    public function find(int $id) {
        return SelectionMaterial::query()->find($id);
    }

    public function search(): LengthAwarePaginator {
        return SelectionMaterial::query()->orderByDesc('created_at')->paginate();
    }

    public function destroy(array $ids) {
        return SelectionMaterial::destroy($ids);
    }

    public function createFromArray(array $data) {
        $author = new SelectionMaterial();
        $author->fill($data);
        $author->save();

        return $author;
    }

    public function updateFromArray(SelectionMaterial $author, array $data) {
        $author->update($data);
        return $author;
    }
}
