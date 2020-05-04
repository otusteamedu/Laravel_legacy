<?php

namespace App\Services\Countries\Repositories;

/**
 * Interface CountryRepositoryInterface
 * @package App\Services\Countries\Repositories
 */
interface CountryRepositoryInterface
{
    public function find(int $id);

    public function search(array $filters = []);
}
