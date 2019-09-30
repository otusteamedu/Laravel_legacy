<?php
/**
 * Description of CountryRepository.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Services\Admin\Repositories;


use App\Model\RoleUser;

class AdminRepository
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
        $country = new RoleUser();
        $country->create($data);
        return $country;
    }

    public function updateFromArray(RoleUser $country, array $data)
    {
        $country->update($data);
        return $country;
    }

}