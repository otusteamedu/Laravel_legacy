<?php
/**
 */

namespace App\Services\Statuses\Repositories;

use App\Models\Status;

interface StatusRepositoryInterface
{
    public function find(int $id);

    public function search(array $filters = []);

    public function createFromArray(array $data): Status;

    public function create(array $data): Status;

    public function updateFromArray(Status $status, array $data);

    public function delete(int $id);


}