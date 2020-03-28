<?php

namespace App\Http\Controllers\Cms\Mstatuses;

use App\Http\Controllers\Controller;
use App\Models\Mstatus;
use Illuminate\Http\Request;

class MstatusesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('tempindex');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mstatus  $mstatus
     * @return \Illuminate\Http\Response
     */
    public function show(Mstatus $mstatus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mstatus  $mstatus
     * @return \Illuminate\Http\Response
     */
    public function edit(Mstatus $mstatus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mstatus  $mstatus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mstatus $mstatus)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mstatus  $mstatus
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mstatus $mstatus)
    {
        //
    }
}
