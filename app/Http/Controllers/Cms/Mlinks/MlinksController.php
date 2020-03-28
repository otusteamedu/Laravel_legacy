<?php

namespace App\Http\Controllers\Cms\Mlinks;

use App\Http\Controllers\Controller;
use App\Models\Mlink;
use Illuminate\Http\Request;

class MlinksController extends Controller
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
     * @param  \App\Models\Mlink  $mlink
     * @return \Illuminate\Http\Response
     */
    public function show(Mlink $mlink)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mlink  $mlink
     * @return \Illuminate\Http\Response
     */
    public function edit(Mlink $mlink)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mlink  $mlink
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mlink $mlink)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mlink  $mlink
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mlink $mlink)
    {
        //
    }
}
