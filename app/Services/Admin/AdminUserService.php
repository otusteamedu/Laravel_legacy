<?php
/**
 * Created by PhpStorm.
 * User: Hollow
 * Date: 09.10.2019
 * Time: 22:27
 */

namespace App\Services\Admin;


use App\Services\Admin\Repositories\AdminUserRepository;

class AdminUserService
{
    private $adminUserRepository;

    public function __construct(AdminUserRepository $adminUserRepository)
    {
        $this->adminUserRepository = $adminUserRepository;
    }

    public function findUser(int $id)
    {
        return $this->adminUserRepository->find($id);
    }

}
