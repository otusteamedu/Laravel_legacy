<?php
/**
 * Description of CountriesService.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Services\Admin;


use App\Model\RoleUser;
use App\Services\Admin\Repositories\AdminRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class AdminService
{

    private $adminRepository;

    public function __construct(
        AdminRepository $adminRepository
    )
    {
        $this->adminRepository = $adminRepository;
    }


    public function findAdminUser(int $id)
    {
        return $this->adminRepository->find($id);
    }


    public function searchAdminUser(): LengthAwarePaginator
    {
        return $this->adminRepository->search();
    }


    public function storeAdminUser(array $data): RoleUser
    {
        $admin= $this->adminRepository->createFromArray($data);

        return $admin;
    }


    public function updateAdminUser(RoleUser $roleUser, array $data): RoleUser
    {
        return $this->adminRepository->updateFromArray($roleUser, $data);
    }

}