<?php

namespace App\Services\EventTypes\Repositories;

/**
 * Interface EventTypeRepositoryInterface
 * @package App\Services\EventTypes\Repositories
 */
interface EventTypeRepositoryInterface
{
    public function find(int $id);

    public function search(array $filters = []);
}
