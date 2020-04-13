<?php
/**
 */

namespace App\Services\Users\Repositories;

use App\Models\User;

interface UserRepositoryInterface
{
    public function find(int $id);

    public function search(array $filters = []);

    public function createFromArray(array $data): User;

    public function create(array $data): User;

    public function updateFromArray(User $user, array $data);

    public function delete(int $id);


    public function getRolesNames(User $user, array $filters = []);

    public function saveRoles(User $user, $roles);

}