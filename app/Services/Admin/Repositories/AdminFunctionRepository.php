<?php
/**
 * Created by PhpStorm.
 * User: Hollow
 * Date: 10.10.2019
 * Time: 0:07
 */

namespace App\Services\Admin\Repositories;


use App\Model\FunctionApi;

class AdminFunctionRepository
{

    public function createFromArray(array $data)
    {
        $roleUser = new FunctionApi();
        $roleUser->create($data);
        return $roleUser;
    }
}