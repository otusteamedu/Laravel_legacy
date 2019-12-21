<?php

namespace App\Services\Authors\Repositories;

interface CachedAuthorRepositoryInterface {

    public function search(array $filters = [], array $with = []);
    public function clearSearchCache();
    public function getBy(array $filters = [], array $with = []);
}
