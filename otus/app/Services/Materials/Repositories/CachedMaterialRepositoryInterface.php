<?php

namespace App\Services\Materials\Repositories;

interface CachedMaterialRepositoryInterface {

    public function search(array $filters = [], array $with = []);
    public function clearSearchCache();

}
