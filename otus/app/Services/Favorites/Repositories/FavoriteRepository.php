<?php

namespace App\Services\Favorites\Repositories;

use App\Models\Favorite;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class FavoriteRepository {

    public function find(int $id) {
        return Favorite::query()->find($id);
    }

    public function search(): LengthAwarePaginator {
        return Favorite::query()->orderByDesc('created_at')->paginate();
    }

    public function destroy(array $ids) {
        return Favorite::destroy($ids);
    }

    public function createFromArray(array $data) {
        $favorite = new Favorite();
        $favorite->fill($data);
        $favorite->save();
        return $favorite;
    }

    public function updateFromArray(Favorite $favorite, array $data) {
        $favorite->update($data);
        return $favorite;
    }
}
