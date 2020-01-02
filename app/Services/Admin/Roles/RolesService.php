<?php


namespace App\Services\Admin\Roles;


use App\Services\Admin\Roles\Handlers\GetRolesListHandler;

/**
 * Class RolesService
 * @package App\Services\Admin\Roles
 */
class RolesService
{
    /**
     * @var GetRolesListHandler
     */
    private $getRolesListHandler;

    /**
     * RolesService constructor.
     * @param GetRolesListHandler $getRolesListHandler
     */
    public function __construct(
        GetRolesListHandler $getRolesListHandler
    )
    {
        $this->getRolesListHandler = $getRolesListHandler;
    }


    /**
     * @return \App\Models\Role[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getRolesList()
    {
        return $this->getRolesListHandler->handle();
    }
}
