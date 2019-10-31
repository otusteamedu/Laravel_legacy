<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Users\Admin\StoreUser;
use App\Http\Requests\Users\Admin\UpdateUser;
use App\Models\User;
use App\Policies\Abilities;
use App\Services\Companies\CompanyService;
use App\Services\Roles\RoleService;
use App\Services\Users\UserService;
use App\Traits\Auth\HasAuthorizationPolicy;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

class UserController extends Controller
{
    use HasAuthorizationPolicy;
    
    protected $modelClass = User::class;
    
    private $userService;
    private $companyService;
    private $roleService;
    
    public function __construct(
        UserService $userService,
        CompanyService $companyService,
        RoleService $roleService
    ) {
        $this->userService = $userService;
        $this->companyService = $companyService;
        $this->roleService = $roleService;
    
        $this->viewShareData();
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return Factory|RedirectResponse|View
     */
    public function index()
    {
        if (!$this->authorizeUserAbility(Abilities::VIEW_ANY)) {
            return $this->redirectIfNoPermission('admin.dashboard', Abilities::VIEW_ANY);
        }
        
        $users = $this->userService->paginateUsersWithTrashed();
        
        return view('admin.models.users.index', compact('users'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|RedirectResponse|View
     */
    public function create()
    {
        if (!$this->authorizeUserAbility(Abilities::CREATE)) {
            // TODO generate routes from trait property
            return $this->redirectIfNoPermission('admin.users.index', Abilities::CREATE);
        }
    
        $currentUser = $this->getCurrentUser();
        $companiesSelectList = $this->companyService->getFormSelectCompanies();
        $allRolesSelectList = $this->roleService->getFormSelectRoles();
        
        return view('admin.models.users.create', compact('currentUser', 'companiesSelectList', 'allRolesSelectList'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreUser  $request
     *
     * @return RedirectResponse
     */
    public function store(StoreUser $request): RedirectResponse
    {
        if (!$this->authorizeUserAbility(Abilities::CREATE)) {
            return $this->redirectIfNoPermission('admin.users.index', Abilities::CREATE);
        }
        
        $this->userService->createUser($request->all());
        
        return redirect()->route('admin.users.index');
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  User  $user
     *
     * @return Factory|RedirectResponse|View
     */
    public function edit(User $user)
    {
        if (!$this->authorizeUserAbility(Abilities::UPDATE, $user)) {
            return $this->redirectIfNoPermission('admin.users.index', Abilities::UPDATE);
        }
        
        $currentUser = $this->getCurrentUser();
        $userRolesSelectList = $this->userService->getFormSelectUserRoles($user);
        
        return view('admin.models.users.edit', compact('user', 'currentUser', 'userRolesSelectList'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateUser  $request
     * @param  User  $user
     *
     * @return RedirectResponse
     */
    public function update(UpdateUser $request, User $user): RedirectResponse
    {
        if (!$this->authorizeUserAbility(Abilities::UPDATE, $user)) {
            return $this->redirectIfNoPermission('admin.users.index', Abilities::UPDATE);
        }
        
        $this->userService->updateUser($user, $request->all());
        
        return redirect()->route('admin.users.edit', compact('user'));
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  User  $user
     *
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(User $user): RedirectResponse
    {
        if (!$this->authorizeUserAbility(Abilities::DELETE, $user)) {
            return $this->redirectIfNoPermission('admin.users.index', Abilities::DELETE);
        }
        
        $this->userService->deleteUser($user);
        
        return redirect()->route('admin.users.index');
    }
    
    /**
     * Restore the specified resource.
     *
     * @param  int  $id
     *
     * @return RedirectResponse
     */
    public function restore(int $id): RedirectResponse
    {
        $user = $this->userService->findUserWithTrashed($id);
        
        if (!$user) {
            // TODO make this redirect as method in trait
            return redirect()->route('admin.users.index')->with('errors', __('admin.users.errors.not_found'));
        }
        
        if (!$this->authorizeUserAbility(Abilities::RESTORE, $user)) {
            return $this->redirectIfNoPermission('admin.users.index', Abilities::RESTORE);
        }
        
        $this->userService->restoreUser($user);
        
        return redirect()->route('admin.users.index');
    }
    
    /**
     * Permanently delete the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return RedirectResponse
     */
    public function forceDelete(int $id): RedirectResponse
    {
        $user = $this->userService->findUserWithTrashed($id);
        
        if (!$user) {
            return redirect()->route('admin.users.index')->with('errors', __('admin.users.errors.not_found'));
        }
        
        if (!$this->authorizeUserAbility(Abilities::FORCE_DELETE, $user)) {
            return $this->redirectIfNoPermission('admin.users.index', Abilities::FORCE_DELETE);
        }
        
        $this->userService->forceDeleteUser($user);
        
        return redirect()->route('admin.users.index');
    }
}
