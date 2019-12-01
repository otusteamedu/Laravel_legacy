<?php

namespace App\Services\Favorites\Repositories;

use App\Models\Favorite;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface FavoriteRepositoryInterface {

    public function find(int $id);

    public function search(array $filters = [], array $with = []): LengthAwarePaginator;

    public function destroy(array $ids);

    public function createFromArray(array $data): Favorite;

    public function updateFromArray(Favorite $favorite, array $data): Favorite;
}
