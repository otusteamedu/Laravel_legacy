<?php

namespace App\Services\Events\Repositories;

use App\Models\Event;

/**
 * Interface EventRepositoryInterface
 * @package App\Services\Events\Repositories
 */
interface EventRepositoryInterface
{
    public function find(int $id);

    public function search(array $filters = []);

    public function createFromArray(array $data): Event;

    public function updateFromArray(Event $event, array $data);

    public function delete(int $id);
}
