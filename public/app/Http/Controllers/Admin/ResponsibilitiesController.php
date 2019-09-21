<?php

namespace App\Http\Controllers\Admin;

use App\Models\Responsibility;
use App\Models\Group;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ResponsibilitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('responsibilities.index', [
            'responsibilities' => Responsibility::orderBy('created_at', 'desc')->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('responsibilities.create', [
            'responsibilities' => [],
            'groups' => Group::get(),
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
        $responsibility = Responsibility::create($request->all());
        return redirect()->route('admin.responsibilities.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Responsibility  $responsibility
     * @return \Illuminate\Http\Response
     */
    public function show(Responsibility $responsibility)
    {
       return view('responsibilities.show',[
           'responsibility'=>$responsibility,
           'group'=>Group::where('id',$responsibility->group_id)->get(),
       ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Responsibility  $responsibility
     * @return \Illuminate\Http\Response
     */
    public function edit(Responsibility $responsibility)
    {
        return view('responsibilities.edit', [
            'responsibility' => $responsibility,
            'groups' => Group::get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Responsibility  $responsibility
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Responsibility $responsibility)
    {
        $responsibility->update($request->all());
        return redirect()->route('admin.responsibilities.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Responsibility  $responsibility
     * @return \Illuminate\Http\Response
     */
    public function destroy(Responsibility $responsibility)
    {
        $responsibility->delete();
        return redirect()->route('admin.responsibilities.index');
    }
}
