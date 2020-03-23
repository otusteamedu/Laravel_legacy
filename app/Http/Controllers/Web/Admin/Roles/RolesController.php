<?php

namespace App\Http\Controllers\Web\Admin\Roles;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Web\Admin\Users\Requests\StoreRoleRequest;
use App\Models\Role;
use App\Policies\Abilities;
use Illuminate\Http\Request;

/**
 * Class RolesController
 * @package App\Http\Controllers\Web\Admin\Roles
 */
class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index()
    {
        $this->authorize(Abilities::VIEW_ANY, Role::class);

        return view('admin.roles.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->authorize(Abilities::CREATE, Role::class);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRoleRequest $request
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(StoreRoleRequest $request)
    {
        $this->authorize(Abilities::CREATE, Role::class);
    }

    /**
     * Display the specified resource.
     *
     * @param Role $role
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Role $role)
    {
        $this->authorize(Abilities::VIEW, Role::class);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Role $role
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Role $role)
    {
        $this->authorize(Abilities::UPDATE, Role::class);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreRoleRequest $request
     * @param Role $role
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(StoreRoleRequest $request, Role $role)
    {
        $this->authorize(Abilities::UPDATE, Role::class);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Role $role
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Role $role)
    {
        $this->authorize(Abilities::DELETE, Role::class);
    }
}
