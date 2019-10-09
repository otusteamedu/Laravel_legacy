<?php
/**
 * Created by PhpStorm.
 * User: Hollow
 * Date: 10.10.2019
 * Time: 0:06
 */

namespace App\Services\Admin;


use App\Model\FunctionApi;
use App\Services\Admin\Repositories\AdminFunctionRepository;

class AdminFunctionService
{
    private $adminFunctionRepository;

    public function __construct(AdminFunctionRepository $adminFunctionRepository)
    {
        $this->adminFunctionRepository = $adminFunctionRepository;
    }

    public function storeFunction(array $data): FunctionApi
    {
        $admin= $this->adminFunctionRepository->createFromArray($data);

        return $admin;
    }
}