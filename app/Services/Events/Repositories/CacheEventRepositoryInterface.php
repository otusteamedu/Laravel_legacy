<?php

namespace App\Services\Events\Repositories;


/**
 * Interface CacheEventRepositoryInterface
 * @package App\Services\Events\Repositories
 */
interface CacheEventRepositoryInterface
{
    public function find(int $id);

    public function search(array $filters = []);

    public function clear();

}
