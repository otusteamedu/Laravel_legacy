<?php

namespace App\Services\Favorites\Repositories;

interface CachedFavoriteRepositoryInterface {

    public function search(array $filters = [], array $with = []);
    public function clearSearchCache();

}
