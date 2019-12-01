<?php

namespace App\Services\Favorites;

use App\Models\Favorite;

use App\Services\Favorites\Repositories\CachedFavoriteRepositoryInterface;
use App\Services\Favorites\Repositories\FavoriteRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class FavoriteService {

    private $favoriteRepository;
    private $cachedFavoriteRepository;

    public function __construct(FavoriteRepositoryInterface $favoriteRepository, CachedFavoriteRepositoryInterface $cachedFavoriteRepository) {
        $this->favoriteRepository = $favoriteRepository;
        $this->cachedFavoriteRepository = $cachedFavoriteRepository;
    }

    public function findFavorite(int $id): Favorite {
        return $this->favoriteRepository->find($id);
    }

    /**
     * @return LengthAwarePaginator
     */
    public function searchFavorites(): LengthAwarePaginator {
        return $this->cachedFavoriteRepository->search();
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
