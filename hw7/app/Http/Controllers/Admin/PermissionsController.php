<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Permission;
use App\Services\Permissions\PermissionsService;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;

class PermissionsController extends Controller
{
    protected $permissionsService;
    protected $breadcrumbs;
    public function __construct(
        PermissionsService $permissionsService
    )
    {
        $this->permissionsService = $permissionsService;
        $this->breadcrumbs = [
            [
                'url' => '/admin',
                'title' => __('messages.admin_panel'),
            ],
            [
                'url' => route('admin.index'),
                'title' => __('messages.permissions'),
            ],


        ];

    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $user = Auth::user();
        if(!$user->hasPermission($request->route()->getName()) && !$user->hasPermission('admin.index') ){
            abort(403);
        }

        return view('admin.permissions.index', [
            'permissions' => $this->permissionsService->searchPermissions(),
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
        return view('admin.permissions.create', [
            'breadcrumbs' => $this->breadcrumbs

        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|unique:permissions,name|max:100',

        ]);

        $this->permissionsService->storePermission($request->all());

        return redirect(route('admin.permissions.index'));
    }

    /**
     * Display the specified resource.
     *
     *
     * @param  0   int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission)
    {
        return view('admin.permissions.edit',
            [
                'permission' => $permission,
                'breadcrumbs' => $this->breadcrumbs
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Permission $permission)
    {
        $result = $this->permissionsService->updatePermission($permission, $request->all());

        if($result == 1){
            return redirect(route('admin.permissions.index'));
        }
        else {
            return back()->with($result);

        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = $this->permissionsService->deletePermission($id);

        if(is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }

        return redirect(route('admin.permissions.index',['result' => $result] ));
    }
}
