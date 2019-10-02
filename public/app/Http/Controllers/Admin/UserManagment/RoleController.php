<?php

namespace App\Http\Controllers\Admin\UserManagment;

use App\User;
use App\Models\Admin\UserManagment\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.user_managment.roles.index', [
            'roles' => Role::get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user_managment.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Role::create($request->all());
        return redirect()->route('admin.user_managment.roles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        return view('admin.user_managment.roles.edit', [
            'role' => $role
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Role $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $role->update($request->all());
        return redirect()->route('admin.user_managment.roles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {

        if($role->users()->count()>0){
            return view('admin.user_managment.roles.edit', [
                'role' => $role,
                'message' => 'Нельзя удалить роль которая назначена пользователям, уберите роль у всех пользователей'
            ]);
        }else{
            $role->delete();
            return redirect()->route('admin.user_managment.roles.index');
        }
    }
}
