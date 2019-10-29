<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Services\Users\UsersService;
use App\Services\Roles\RolesService;

use App\Models\Role;

use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use SebastianBergmann\CodeCoverage\TestFixture\C;
use Session;
use Cache;

class UsersController extends BaseAdminController
{
    protected $usersService;
    protected $rolesService;
    protected $breadcrumbs;

    public function __construct(
        UsersService $usersService,
        RolesService $rolesService

    )
    {
        $this->usersService = $usersService;
        $this->rolesService = $rolesService;
        $this->breadcrumbs = $this->getAdminBreadcrumbs();
        array_push($this->breadcrumbs,
            [
                'url' => route('admin.users.index'),
                'title' => __('messages.users'),
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
            //$users= $this->usersService->searchUsers();
        $users = $this->usersService->searchCachedUsers();
        return view('admin.users.index', [
            'users' => $users,
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
        return view('admin.users.create', [
            'breadcrumbs' => $this->breadcrumbs,
            'roles' => $this->rolesService->searchRolesToArray(),

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
            'name' => 'required|unique:users,name|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed'
        ]);


        $this->usersService->storeUser($request->all());

        return redirect(route('admin.users.index'));
    }

    /**
     * Display the specified resource.
     *
     *
     * @param  0   int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        // dd($this->rolesService->searchRoles());
        return view('admin.users.edit',
            [
                'user' => $user,
                'roles' => $this->rolesService->searchRolesToArray(),
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
    public function update(Request $request, User $user)
    {
        $result = $this->usersService->updateUser($user, $request->all());

        if ($result == 1) {
            Session::flash('success', __('users.user_was_updated'));
            return redirect(route('admin.users.index'));
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
        $result = $this->usersService->deleteUser($id);

        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }

        return redirect(route('admin.users.index', ['result' => $result]));
    }
}
