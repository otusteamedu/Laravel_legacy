<?php

namespace App\Http\Controllers;

use App\Models\UserFavoriteStock;
use Illuminate\Http\Request;

class UserFavoriteStockController extends Controller
{
    /**
     * StockController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserFavoriteStock  $userFavoriteStock
     * @return \Illuminate\Http\Response
     */
    public function show(UserFavoriteStock $userFavoriteStock)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserFavoriteStock  $userFavoriteStock
     * @return \Illuminate\Http\Response
     */
    public function edit(UserFavoriteStock $userFavoriteStock)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserFavoriteStock  $userFavoriteStock
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserFavoriteStock $userFavoriteStock)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserFavoriteStock  $userFavoriteStock
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserFavoriteStock $userFavoriteStock)
    {
        //
    }
}
