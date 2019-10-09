<?php
/**
 * Description of CountryRepository.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Services\Admin\Repositories;


use App\Model\RoleUser;

class AdminRoleRepository
{

    public function find(int $id)
    {
        return RoleUser::find($id);
    }

    public function search()
    {
        return RoleUser::paginate();
    }

    public function createFromArray(array $data)
    {
        $roleUser = new RoleUser();
        $roleUser->create($data);
        return $roleUser;
    }

    public function updateFromArray(RoleUser $roleUser, array $data)
    {
        $roleUser->update($data);
        return $roleUser;
    }

}