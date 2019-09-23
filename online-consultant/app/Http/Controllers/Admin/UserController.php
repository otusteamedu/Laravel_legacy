<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Users\StoreUser;
use App\Http\Requests\Users\UpdateUser;
use App\Models\User;
use App\Services\Companies\CompanyService;
use App\Services\Users\UserService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

class UserController extends Controller
{
    private $userService;
    private $companyService;
    
    public function __construct(
        UserService $userService,
        CompanyService $companyService
    ) {
        $this->userService = $userService;
        $this->companyService = $companyService;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        // TODO показывать роли юзера в index, edit, create
        $users = $this->userService->paginateUsersWithTrashed();
        
        return view('admin.models.users.index', compact('users'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        $companiesSelectList = $this->companyService->getFormSelectCompanies();
        
        return view('admin.models.users.create', compact('companiesSelectList'));
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
        $this->userService->createUser($request->all());
        
        return redirect()->route('admin.users.index');
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  User  $user
     *
     * @return Factory|View
     */
    public function edit(User $user)
    {
        return view('admin.models.users.edit', compact('user'));
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
        $this->userService->restoreUser($id);
        
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
        $this->userService->forceDeleteUser($id);
        
        return redirect()->route('admin.users.index');
    }
}
