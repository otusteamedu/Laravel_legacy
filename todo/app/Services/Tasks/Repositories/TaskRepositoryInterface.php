<?php
/**
 */

namespace App\Services\Tasks\Repositories;

use App\Models\Task;

interface TaskRepositoryInterface
{
    public function find(int $id);

    public function search(array $filters = []);

    public function searchToArray(array $filters = []);

    public function searchByUsers(array $filters = []);

    public function createFromArray(array $data): Task;

    public function create(array $data): Task;

    public function updateFromArray(Task $task, array $data);

    public function delete(int $id);


}