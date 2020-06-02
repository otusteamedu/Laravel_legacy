<?php

namespace App\Http\Controllers\Staffs;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\User;
use App\Services\Users\UsersService;
use Illuminate\Http\Request;

class Staffs extends Controller
{

    /**
     * @var UsersService
     */
    private $usersService;

    public function __construct(UsersService $usersService)
    {
        $this->usersService = $usersService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $list = $this->usersService->searchUsers(Group::STAFFS);
        $list->load('group');

        return view('staffs.index')->with([
            'user' => ['id' => 1], // @todo
            'list' => $list,
            'currentPage' => 'staffs',
            'title' => __("staffs/general.title")
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('staffs.create')->with([
            'user' => ['id' => 1], // @todo
            'currentPage' => 'staffs',
            'title' => __("staffs/create.title")
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $data = array_merge(
            $request->all(),
           ['group_id' => Group::STAFFS[rand(0,2)]] // @todo
        );
        $this->usersService->storeUser($data);

        return redirect(route('staffs.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $staff = $this->usersService->findUser($id);
        return view('staffs.show')->with([
            'user' => ['id' => 1], // @todo
            'staff' => $staff,
            'currentPage' => 'staffs',
            'title' => $staff->name
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit(int $id)
    {
        $staff = $this->usersService->findUser($id);
        return view('staffs.edit')->with([
            'user' => ['id' => 1], // @todo
            'staff' => $staff,
            'currentPage' => 'staffs',
            'title' => __("staffs/edit.title")
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $staff = User::findOrFail($id);

        $this->usersService->updateUser($staff, $request->all());

        return redirect(route('staffs.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $staff = User::findOrFail($id);

        $this->usersService->deleteUser($staff);

        return redirect(route('staffs.index'));
    }
}
