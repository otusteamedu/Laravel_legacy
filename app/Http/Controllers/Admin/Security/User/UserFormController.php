<?php


namespace App\Http\Controllers\Admin\Security\User;


use App\Base\Controller\AbstractFormController;
use App\Base\Service\ServiceException;
use App\Helpers\Views\AdminHelpers;
use App\Models\Role;
use App\Models\User;
use App\Services\Interfaces\IUserService;
use App\Services\Interfaces\IRoleService;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Exception;

class UserFormController extends AbstractFormController
{
    protected $userService;
    protected $roleService;

    public function __construct(
        IUserService $userService,
        IRoleService $roleService
    ) {
        $this->userService = $userService;
        $this->roleService = $roleService;
    }

    /**
     * @return View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create(): View
    {
        /** @var \App\Repositories\Interfaces\IUserRepository $repository */
        $repository = $this->userService->getRepository();
        $this->authorize('create', User::class);

        $uploads = $this->Uploader()->loadData();
        $roles = $this->roleService->findByFilter()->reject(
            function(Role $role) {
                return $role->isRoot();
            }
        );

        return view('admin.users.create', [
            'roles' => AdminHelpers::forSelect($roles),
            'sexes' => $repository->getSexes(),
            'userId' => 0,
            'name' => '',
            'surname' => '',
            'email' => '',
            'phone' => '',
            'birthday' => '',
            'sex' => null,
            'file' => null,
            'active' => true,
            'confirm_user' => true,
            'change_token_api' => true,
            'roles_id' => [],
            'uploads' => isset($uploads['file']) ? $uploads['file'] : []
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Request $request)
    {
        $this->authorize('store', User::class);
        try {
            /** @var User $user */
            $user = $this->userService->store($request->all());
            $this->status(__('success.users.stored',
                ['name' => $user->name, 'surname' => $user->surname, 'email' => $user->email]));
        }
        catch (ValidationException $exception) {
            return redirect(route('admin.users.create'))
                ->withErrors($exception->errors())
                ->withInput();
        }
        catch (ServiceException $exception) {
            return redirect(route('admin.users.create'))
                ->withErrors($exception->getMessages(), 'default')
                ->withInput();
        }

        return redirect(route('admin.users.index'));
    }
    /**
     * @param int $itemId
     * @return View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(int $itemId): View
    {
        /** @var User $user */
        $user = $this->userService->findModel($itemId);
        $this->authorize('edit', $user);

        /** @var \App\Repositories\Interfaces\IUserRepository $repository */
        $repository = $this->userService->getRepository();

        $file = null;
        if($user->file) {
            $file = $this->uploadService->getFileService()->getLocalFile($user->file);
            if($file) {
                $file = $user->file->attributesToArray();
                $file['file_src'] = $this->uploadService->getFileService()->getAssetUrl($user->file);
            }
        }

        $uploads = $this->uploadService->loadData();
        $roles = $this->roleService->findByFilter();

        return view('admin.users.edit', [
            'roles' => AdminHelpers::forSelect($roles),
            'sexes' => $repository->getSexes(),
            'userId' => $user->id,
            'name' => $user->name,
            'surname' => $user->surname,
            'email' => $user->email,
            'phone' => $user->phone,
            'birthday' => AdminHelpers::Date_db_site($user->birthday),
            'sex' => $user->sex,
            'file' => $file,
            'active' => (!!$user->active),
            'confirm_user' => true,
            'change_token_api' => false,
            'roles_id' => $user->roles->pluck('id')->toArray(),
            'uploads' => isset($uploads['file']) ? $uploads['file'] : []
        ]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $itemId
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, int $itemId)
    {
        /** @var User $user */
        $user = $this->userService->findModel($itemId);
        $this->authorize('update', $user);

        try {
            /** @var User $user */
            $user = $this->userService->update($itemId,
                array_merge(['role_id' => []], $request->all()));
            $this->status(__('success.users.updated',
                ['name' => $user->name, 'surname' => $user->surname, 'email' => $user->email]));
        }
        catch (ValidationException $exception) {
            redirect(route('admin.users.edit', ['itemId' => $itemId]))
                ->withErrors($exception->errors())
                ->withInput();
        }
        catch (ServiceException $exception) {
            redirect(route('admin.users.edit', ['itemId' => $itemId]))
                ->withErrors($exception->getMessages(), 'default')
                ->withInput();
        }

        return redirect(route('admin.users.index'));
    }
}
