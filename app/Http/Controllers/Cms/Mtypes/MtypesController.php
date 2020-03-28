<?php

namespace App\Http\Controllers\Cms\Mtypes;

use App\Http\Controllers\Controller;
use App\Models\Mtype;
use Illuminate\Http\Request;

class MtypesController extends Controller
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
     * @param  \App\Models\Mtype  $mtype
     * @return \Illuminate\Http\Response
     */
    public function show(Mtype $mtype)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mtype  $mtype
     * @return \Illuminate\Http\Response
     */
    public function edit(Mtype $mtype)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mtype  $mtype
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mtype $mtype)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mtype  $mtype
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mtype $mtype)
    {
        //
    }
}
