<?php

namespace App\Services\Materials\Repositories;

use App\Models\Material;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface MaterialsRepositoryInterface {

    public function find(int $id);

    public function search(): LengthAwarePaginator;

    public function destroy(array $ids);

    public function createFromArray(array $data): Material;

    public function updateFromArray(Material $material, array $data): Material;
}
