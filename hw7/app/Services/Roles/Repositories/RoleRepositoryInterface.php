<?php
/**
 */

namespace App\Services\Roles\Repositories;

use App\Models\Role;

interface RoleRepositoryInterface
{
    public function find(int $id);

    public function search(array $filters = []);

    public function searchToArray(array $filters = []);

    public function createFromArray(array $data): Role;

    public function create(array $data): Role;

    public function updateFromArray(Role $role, array $data);

    public function delete(int $id);

    public function permissions(Role $role, array $filters = []);
}