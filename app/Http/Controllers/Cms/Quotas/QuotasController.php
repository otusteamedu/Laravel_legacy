<?php

namespace App\Http\Controllers\Cms\Quotas;

use App\Http\Controllers\Controller;
use App\Models\Quota;
use Illuminate\Http\Request;

class QuotasController extends Controller
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
     * @param  \App\Models\Quota  $quota
     * @return \Illuminate\Http\Response
     */
    public function show(Quota $quota)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Quota  $quota
     * @return \Illuminate\Http\Response
     */
    public function edit(Quota $quota)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Quota  $quota
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Quota $quota)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Quota  $quota
     * @return \Illuminate\Http\Response
     */
    public function destroy(Quota $quota)
    {
        //
    }
}
