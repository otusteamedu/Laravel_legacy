<?php
/**
 * @copyright Copyright (c) Archvile <info@0x25.ru>
 * @link https://0x25.ru
 */

namespace App\Services\Users\Repositories;

use App\Models\User;

interface UsersRepositoryInterface
{
    /**
     * @param  User  $profile
     * @param  array  $data
     *
     * @return bool
     */
    public function update(User $profile, array $data = []) :bool;
}