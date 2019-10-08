<?php
/**
 */

namespace App\Services\Permissions\Repositories;

use App\Models\Permission;

interface PermissionRepositoryInterface
{
    public function find(int $id);

    public function search(array $filters = []);

    public function createFromArray(array $data): Permission;

    public function create(array $data): Permission;

    public function updateFromArray(Permission $permission, array $data);

    public function delete(int $id);
}