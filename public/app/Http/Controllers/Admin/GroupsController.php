<?php

namespace App\Http\Controllers\Admin;

use App\Models\Group;
use App\Models\Flow;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        $groups = Group::orderBy('created_at', 'desc')->paginate(10);
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
        $group = Group::create($request->all());
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
            'responsibilities'=> $group->load(['responsibilities']),
            'reasons'=>$group->load(['reasons']),
            'flows'=> Flow::orderBy('created_at', 'desc')->where('group_id', $group->id)->limit(10)->get()
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
        $group->delete();
        return redirect()->route('admin.groups.index');
    }
}
