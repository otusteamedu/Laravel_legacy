<?php

namespace App\Services\Authors\Repositories;

use App\Models\Author;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface AuthorRepositoryInterface {
    public function find(int $id);

    public function search(array $filters = [], array $with = []): LengthAwarePaginator;

    public function destroy(array $ids);

    public function createFromArray(array $data): Author;

    public function updateFromArray(Author $author, array $data): Author;

    public function getBy(array $filters = [], array $with = []);
}
