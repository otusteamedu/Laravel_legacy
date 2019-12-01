<?php

namespace App\Services\Categories\Repositories;

interface CachedCategoryRepositoryInterface {

    public function search(array $filters = [], array $with = []);
    public function clearSearchCache();

}
