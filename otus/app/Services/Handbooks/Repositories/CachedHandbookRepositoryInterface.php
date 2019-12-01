<?php

namespace App\Services\Handbooks\Repositories;

interface CachedHandbookRepositoryInterface {

    public function search(array $filters = [], array $with = []);
    public function clearSearchCache();

}
