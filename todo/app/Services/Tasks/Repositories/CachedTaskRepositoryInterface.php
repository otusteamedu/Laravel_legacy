<?php

namespace App\Services\Tasks\Repositories;


interface CachedTaskRepositoryInterface
{

    public function search(array $filters = [], array $with = []);

    public function clearSearchCache();

}