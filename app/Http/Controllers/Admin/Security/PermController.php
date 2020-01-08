<?php


namespace App\Http\Controllers\Admin\Security;


use App\Base\Controller\AbstractController;
use App\Repositories\Interfaces\IModuleRepository;
use App\Repositories\Interfaces\IRoleRepository;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class PermController extends AbstractController
{
    protected $moduleRepository;
    protected $roleRepository;

    public function __construct(
        IModuleRepository $moduleRepository,
        IRoleRepository $roleRepository)
    {
        $this->moduleRepository = $moduleRepository;
        $this->roleRepository = $roleRepository;
    }

    /**
     * Показать модули и права для установки, тут обойдемся без сервисов
     * @return View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index()
    {
        Gate::authorize('view-perms');

        return view('admin.security.perms', [
            'modulesAccess' => $this->moduleRepository->getModuleAccess(),
            'permissions' => $this->moduleRepository->getPermissions(),
            'roles' => $this->roleRepository->getList4Perms()
        ]);
    }

    /**
     * Сохранить доступы, тут обойдемся без сервисов
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function save(Request $request)
    {
        Gate::authorize('edit-perms');

        $this->moduleRepository->savePermissions($request->get('permissions', []));
        $this->status(__('success.perms.stored'));

        return redirect(route('admin.security.index'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function modules()
    {
        return view('admin.security.index', [
            'modules' => $this->moduleRepository->getList()->all()
        ]);
    }
}
