<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\Roles\RolesService;

/**
 * Class RolesController
 * @package App\Http\Controllers\Admin
 */
class RolesController extends Controller
{
    /**
     * @var RolesService
     */
    private $service;

    /**
     * RolesController constructor.
     * @param RolesService $service
     */
    public function __construct(
        RolesService $service
    )
    {
        $this->service = $service;
    }

    /**
     * @return string
     */
    public function getList()
    {
        return $this->service->getRolesList();
    }
}
