<?php
/**
 * @copyright Copyright (c) Archvile
 * @link https://0x25.ru
 */

namespace App\Services\Users;

use App\Models\User;
use App\Services\Users\Repositories\UsersRepositoryInterface;

class UsersService
{

    /** @var UsersRepositoryInterface */
    protected $usersRepository;

    public function __construct(UsersRepositoryInterface $usersRepository)
    {
        $this->usersRepository = $usersRepository;
    }

    /**
     * @param  User  $profile
     * @param  array  $data
     *
     * @return bool
     */
    public function update(User $profile, array $data = []) :bool
    {
        return $this->usersRepository->update($profile, $data);
    }

}