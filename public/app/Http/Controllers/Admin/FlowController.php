<?php

namespace App\Http\Controllers\Admin;

use App\Models\Flow;
use App\Models\Group;
use App\Models\Responsibility;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FlowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($request)
    {
        return view('flows.create', [
            'reasons' => [],
            'groups' => Group::get(),
            'group_id' => $request
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //получаем имя за кого сдали
        if ($request->responsibility_id) {
            $responsibility = Responsibility::find($request->responsibility_id);
            $request['text'] = "Сдали за " . $responsibility->name;
        }

        $flow = Flow::create($request->all());

        //пересчитывем сумму группы
        $group = Group::find($request->group_id);
        if($request->operation == 1) {
            $group->total_cache = $group->total_cache + $request->cash;
        }elseif($request->operation == 2){
            $group->total_cache = $group->total_cache - $request->cash;
        }
        $group->save();


        //TODO как добавить выражение
        //Group::where('id', $request->group_id)->update(['total_cache' => total_cache + $request->cash]);

        if ($request->responsibility_id != 0) {
            return redirect()->back();
        }

        return redirect()->route('admin.groups.show.group', ['group'=>$request->group_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Flow $flow
     * @return \Illuminate\Http\Response
     */
    public function show(Flow $flow)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Flow $flow
     * @return \Illuminate\Http\Response
     */
    public function edit(Flow $flow)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Flow $flow
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Flow $flow)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Flow $flow
     * @return \Illuminate\Http\Response
     */
    public function destroy(Flow $flow)
    {
        //
    }
}
