<?php
/**
 * Created by PhpStorm.
 * User: Hollow
 * Date: 09.10.2019
 * Time: 22:28
 */

namespace App\Services\Admin\Repositories;


use App\User;

class AdminUserRepository
{
    public function find(int $id)
    {
        return User::find($id);
    }
}