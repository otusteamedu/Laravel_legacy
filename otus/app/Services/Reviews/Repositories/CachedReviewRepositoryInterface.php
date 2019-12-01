<?php

namespace App\Services\Reviews\Repositories;

interface CachedReviewRepositoryInterface {

    public function search(array $filters = [], array $with = []);
    public function clearSearchCache();
}
