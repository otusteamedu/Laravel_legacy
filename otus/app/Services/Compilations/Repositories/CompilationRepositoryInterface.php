<?php

namespace App\Services\Compilations\Repositories;

use App\Models\Compilation;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface CompilationRepositoryInterface {
    public function find(int $id);

    public function search(array $filters = [], array $with = []): LengthAwarePaginator;

    public function destroy(array $ids);

    public function createFromArray(array $data): Compilation;

    public function updateFromArray(Compilation $compilation, array $data): Compilation;
}
