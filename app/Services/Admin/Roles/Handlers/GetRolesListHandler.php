<?php


namespace App\Services\Admin\Roles\Handlers;


use App\Services\Admin\Roles\Repositories\RolesRepository;

/**
 * Class GetRolesListHandler
 * @package App\Services\Admin\Roles\Handlers
 */
class GetRolesListHandler
{
    /**
     * @var RolesRepository
     */
    private $rolesRepository;

    /**
     * GetRolesListHandler constructor.
     * @param RolesRepository $rolesRepository
     */
    public function __construct(
        RolesRepository $rolesRepository
    )
    {
        $this->rolesRepository = $rolesRepository;
    }


    /**
     * @return \App\Models\Role[]|\Illuminate\Database\Eloquent\Collection
     */
    public function handle()
    {
        return $this->rolesRepository->getList();
    }
}
