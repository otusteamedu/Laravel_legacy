<?php

namespace App\Http\Controllers\admin;

use App\Model\RoleUser;
use App\Services\Admin\AdminService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;

class AdminController extends Controller
{
    protected $adminService;

    public function __construct(
        AdminService $adminService
    )
    {
      //  $this->middleware('shareCommonData');
        $this->adminService = $adminService;
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
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

        $model = RoleUser::where('user_id', $request->input('user_id'))->first();

        if (isset($model)){
            $this->adminService->updateAdminUser($model, $request->all());
        }else{
            $this->adminService->storeAdminUser($request->all());
        }



        return view('admin.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
//        $posts = RoleUser::isAdmin();
//
//        if(!$posts){
//            return abort('404');
//        }
        return view('admin.index', ['user' => RoleUser::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
