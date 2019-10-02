<?php

namespace App\Http\Controllers\Admin;


use App\Models\Reason;
use App\Models\Group;
use App\Models\Responsibility;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReasonsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('reasons.index', [
            'reasons' => Reason::orderBy('created_at', 'desc')->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($request)
    {
        return view('reasons.create', [
            'reasons' => [],
            'groups' => Group::get(),
            'group_id'=>$request
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $reason = Reason::create($request->all());
//        return redirect()->route('admin.reasons.index');
        return redirect()->route('admin.groups.show',$request['group_id']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reason  $reason
     * @return \Illuminate\Http\Response
     */
    public function show(Reason $reason)
    {
        return view('reasons.show',[
            'reason'=>$reason,
            'group'=>Group::where('id',$reason->group_id)->get(),
            'responsibilities'=>Responsibility::where('group_id',$reason->group_id)->get(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reason  $reason
     * @return \Illuminate\Http\Response
     */
    public function edit(Reason $reason)
    {
        return view('reasons.edit', [
            'reason' => $reason,
            'groups' => Group::get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reason  $reason
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reason $reason)
    {
        $reason->update($request->all());
//        return redirect()->route('admin.reasons.index');
        return redirect()->route('admin.groups.show',$request['group_id']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reason  $reason
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reason $reason)
    {
        $reason->delete();
//        return redirect()->route('admin.reasons.index');
        return redirect()->route('admin.groups.show',$reason['group_id']);
    }
}
