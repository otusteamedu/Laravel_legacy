<?php

namespace App\Services\Compilations\Repositories;

interface CachedCompilationRepositoryInterface {

    public function search(array $filters = [], array $with = []);
    public function clearSearchCache();

}
