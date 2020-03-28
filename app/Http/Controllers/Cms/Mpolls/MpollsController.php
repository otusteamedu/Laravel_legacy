<?php

namespace App\Http\Controllers\Cms\Mpolls;

use App\Http\Controllers\Controller;
use App\Models\Mpoll;
use Illuminate\Http\Request;

class MpollsController extends Controller
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
     * @param  \App\Models\Mpoll  $mpoll
     * @return \Illuminate\Http\Response
     */
    public function show(Mpoll $mpoll)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mpoll  $mpoll
     * @return \Illuminate\Http\Response
     */
    public function edit(Mpoll $mpoll)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mpoll  $mpoll
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mpoll $mpoll)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mpoll  $mpoll
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mpoll $mpoll)
    {
        //
    }
}
