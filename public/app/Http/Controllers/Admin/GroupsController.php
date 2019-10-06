<?php

namespace App\Http\Controllers\Admin;

use App\Models\Group;
use App\Models\Flow;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Gate;

class GroupsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        start_measure('start111');

       // $groups = Group::orderBy('created_at', 'desc')->where('created_by', Auth::id())->paginate(10);


        $groups = User::find(Auth::id())->groups()->paginate(10);


        //$groups->load(['responsibilities']);
        return view('groups.index', [
            'groups' => $groups,
        ]);
//        stop_measure('start111');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('groups.create', []);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $userID = Auth::id();
        $request['created_by'] = $userID;
        //return $request;
        $group = Group::create($request->all());

        $group->users()->attach($userID);

        return redirect()->route('admin.groups.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Group $group
     * @return \Illuminate\Http\Response
     */
    public function show(Group $group)
    {
        return view('groups.show', [
            'group' => $group,
            'responsibilities' => $group->load(['responsibilities']),
            'reasons' => $group->load(['reasons']),
            'flows' => Flow::orderBy('created_at', 'desc')->where('group_id', $group->id)->limit(10)->get(),
            'users' => Group::find($group->id)->users()->get(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Group $group
     * @return \Illuminate\Http\Response
     */
    public function edit(Group $group)
    {
        if (Gate::denies('is-owner', $group)) {
            return 'нет прав';
        }

        return view('groups.edit', [
            'group' => $group
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Group $group
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Group $group)
    {
        if (Gate::denies('is-owner', $group)) {
            return 'нет прав';
        }

        $group->update($request->all());
        return redirect()->route('admin.groups.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Group $group
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group)
    {
        if (Gate::denies('is-owner', $group)) {
            return 'нет прав';
        }

        $group->delete();
        return redirect()->route('admin.groups.index');
    }

    /**
     * List users for invite to group
     *
     * @param Group $group
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function invite(Group $group)
    {

        $users = User::get();

        return view('groups.invite', [
            'group' => $group,
            'users' => $users]);
    }

    /**
     *Add User to Group
     *
     */
    public function addUser(Request $request, Group $group)
    {

        if ($request->input('user_id')):
            $group->users()->attach($request->input('user_id'));
        endif;
        return redirect()->back()->with('message', 'пользователь добавлен');
    }
}
