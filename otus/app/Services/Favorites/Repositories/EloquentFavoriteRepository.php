<?php

namespace App\Services\Favorites\Repositories;

use App\Models\Favorite;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class EloquentFavoriteRepository implements FavoriteRepositoryInterface {

    public function find(int $id) {
        return Favorite::query()->find($id);
    }

    public function search(array $filters = [], array $with = []): LengthAwarePaginator {
        return Favorite::query()
            ->orderByDesc('created_at')
            ->with($with)
            ->paginate();
    }

    public function destroy(array $ids) {
        return Favorite::destroy($ids);
    }

    public function createFromArray(array $data): Favorite {
        $favorite = new Favorite();
        $favorite->fill($data);
        $favorite->save();
        return $favorite;
    }

    public function updateFromArray(Favorite $favorite, array $data): Favorite {
        $favorite->update($data);
        return $favorite;
    }
}
