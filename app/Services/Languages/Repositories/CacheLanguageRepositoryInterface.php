<?php

namespace App\Services\Languages\Repositories;


/**
 * Interface CacheLanguageRepositoryInterface
 * @package App\Services\Languages\Repositories
 */
interface CacheLanguageRepositoryInterface
{
    public function find(int $id);

    public function search(array $filters = []);

    public function clear();
}
