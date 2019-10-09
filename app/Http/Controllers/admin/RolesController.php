<?php

namespace App\Http\Controllers\Admin;

use App\Model\RoleUser;
use App\Services\Admin\AdminRoleService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;

class RolesController extends Controller
{

    protected $adminIndexService;
    protected $response = null;

    public function __construct(
        AdminRoleService $adminIndexService
    )
    {
        //  $this->middleware('shareCommonData');
        $this->adminIndexService = $adminIndexService;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {

        return view('admin.rolesUser.index', [
            'response' => $this->response,
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request  $request)
    {
        try {
            $this->validate($request, [
                'user_id' => 'required|max:3',
                'role_id' => 'required|max:3'
            ]);
        } catch (ValidationException $e) {
            return view('admin.rolesUser.index')
                ->with($request->all())
                ->withErrors($e->validator);
        }

        $model = RoleUser::where('user_id', $request->input('user_id'))->first();

        if (isset($model)){
            $userUpdate = $this->adminIndexService->updateAdminUser($model, $request->all());
            if ($userUpdate->wasChanged()) {
                $this->response = 'Роль пользователя успешно изменена';
            }

        }else{
            $userCreate = $this->adminIndexService->storeAdminUser($request->all());
            if($userCreate->exists()){
                $this->response = 'Пользователь успешно создан';
            }

        }

        return view('admin.rolesUser.index', [
            'response' => $this->response,
        ]);
    }
}
