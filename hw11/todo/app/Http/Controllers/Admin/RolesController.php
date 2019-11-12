<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Role;
use App\Services\Roles\RolesService;
use App\Models\Permission;
use App\Services\Permissions\PermissionsService;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;


class RolesController extends BaseAdminController
{
    protected $rolesService;
    protected $permissionsService;
    protected $breadcrumbs;

    public function __construct(
        RolesService $rolesService,
        PermissionsService $permissionService


    )
    {
        $this->rolesService = $rolesService;
        $this->permissionsService = $permissionService;
        $this->breadcrumbs = $this->getAdminBreadcrumbs();
        array_push($this->breadcrumbs,
            [
                'url' => route('admin.roles.index'),
                'title' => __('messages.roles'),
            ]
        );

    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $this->checkCurrentUserRouteAccess($user, $request->route()->getName());

        return view('admin.roles.index', [
            'roles' => $this->rolesService->searchRoles(),
            'breadcrumbs' => $this->breadcrumbs
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.roles.create', [

            'role_permissions' => [],
            'permissions' => $this->permissionsService->searchPermissions(),
            'breadcrumbs' => $this->breadcrumbs

        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|unique:roles,name|max:100',

        ]);

        $this->rolesService->storeRole($request->all());

        return redirect(route('admin.roles.index'));
    }

    /**
     * Display the specified resource.
     *
     *
     * @param  0   int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {


        return view('admin.roles.edit',
            [
                'role' => $role,
                'role_permissions' => $this->rolesService->searchRolePermissions($role),
                'permissions' => $this->permissionsService->searchPermissions(),
                'breadcrumbs' => $this->breadcrumbs
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {

        $result = $this->rolesService->updateRole($role, $request->all());

        if ($result == 1) {
            return redirect(route('admin.roles.index'));
        } else {
            return back()->with($result);

        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = $this->rolesService->deleteRole($id);

        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }

        return redirect(route('admin.roles.index', ['result' => $result]));
    }
}
