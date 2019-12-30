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
     * @return string
     */
    public function getRolesList()
    {
        return $this->getRolesListHandler->handle();
    }
}
