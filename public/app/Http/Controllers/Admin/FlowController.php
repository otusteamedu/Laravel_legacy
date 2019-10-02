<?php

namespace App\Http\Controllers\Admin;

use App\Models\Flow;
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // return $request;
        $flow = Flow::create($request->all());
//        return redirect()->route('admin.reasons.index');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Flow  $flow
     * @return \Illuminate\Http\Response
     */
    public function show(Flow $flow)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Flow  $flow
     * @return \Illuminate\Http\Response
     */
    public function edit(Flow $flow)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Flow  $flow
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Flow $flow)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Flow  $flow
     * @return \Illuminate\Http\Response
     */
    public function destroy(Flow $flow)
    {
        //
    }
}
