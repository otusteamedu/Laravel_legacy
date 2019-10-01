<?php

namespace App\Http\Controllers\Admin;

use App\Model\RoleUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;

class RolesController extends Controller
{

    public function __construct(RoleUser $roleUser)
    {
        $this->roleUser = $roleUser;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('admin.index');
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
            return view('admin.index')
                ->with($request->all())
                ->withErrors($e->validator);
        }

        $existUser = RoleUser::where('user_id', $request->input('user_id'))->first();

        if (isset($existUser)){
            $existUser->update($request->all());
        }else{
            $this->roleUser->create($request->all());
        }

        return view('admin.index');
    }
}
