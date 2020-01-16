<?php
/**
 * @copyright Copyright (c) Archvile <info@0x25.ru>
 * @link https://0x25.ru
 */

namespace App\Services\Users\Repositories;

use App\Models\User;

class EloquentUsersRepository implements UsersRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function update(User $profile, array $data = []) :bool
    {
        return $profile->update($data);
    }

}