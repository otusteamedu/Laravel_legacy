<?php

namespace App\Services\Favorites;

use App\Models\Favorite;

use App\Services\Favorites\Repositories\FavoriteRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class FavoriteService {

    private $favoriteRepository;

    public function __construct(FavoriteRepository $favoriteRepository) {
        $this->favoriteRepository = $favoriteRepository;
    }

    public function findCategory(int $id) {
        return $this->favoriteRepository->find($id);
    }

    /**
     * @return LengthAwarePaginator
     */
    public function searchFavorites(): LengthAwarePaginator {
        return $this->favoriteRepository->search();
    }

    /**
     * @param array $data
     * @return Favorite
     */
    public function storeFavorite(array $data) {
        return $this->favoriteRepository->createFromArray($data);
    }

    /**
     * @param Favorite $category
     * @param array $data
     */
    public function updateFavorite(Favorite $category, array $data) {
        $this->favoriteRepository->updateFromArray($category, $data);
    }

    /**
     * @param array $ids
     */
    public function destroyFavorites(array $ids) {
        $this->favoriteRepository->destroy($ids);
    }
}
