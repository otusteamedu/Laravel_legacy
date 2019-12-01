<?php

namespace App\Services\Journals\Repositories;

interface CachedJournalRepositoryInterface {

    public function search(array $filters = [], array $with = []);
    public function clearSearchCache();

}
