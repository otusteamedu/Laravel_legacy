<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserGroup;
use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Renderable;

class UserGroupsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Renderable
     */
    public function index()
    {
        $groups = UserGroup::paginate(20);
        return  view('admin.usergroups-list', compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $groupId = $request->id;
        try {
            $group = UserGroup::updateOrCreate(['id' => $groupId], $data);
            \Session::flash('alert-success', sprintf('Группа #%d успешно %s', $group->id, $request->id ? 'отредактирована' : 'создана'));
        } catch (\Exception $e) {
            \Session::flash('alert-danger', sprintf('Возникла ошибка при %s группы: %s', $request->id ? 'редактировании': 'создании', $e->getMessage()));
        }
        return redirect()->route('usergroups.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserGroup  $userGroup
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(UserGroup $userGroup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit($id)
    {
        $userGroup = UserGroup::findOrFail($id);
        return response()->json($userGroup);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserGroup  $userGroup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserGroup $userGroup)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        try {
            $userGroup = UserGroup::findOrFail($id) ;
            \Session::flash('alert-success', sprintf('Группа #%d успешно удалена', $id));
        } catch (\Exception $e) {
            \Session::flash('alert-danger', sprintf('Возникла ошибка при удалении группы #%d: %s', $id, $e->getMessage()));
        }
        return redirect()->route('usergroups.index');
    }
}
