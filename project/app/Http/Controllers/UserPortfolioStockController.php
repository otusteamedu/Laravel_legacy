<?php

namespace App\Http\Controllers;

use App\Models\UserPortfolioStock;
use Illuminate\Http\Request;

class UserPortfolioStockController extends Controller
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
     * @param  \App\Models\UserPortfolioStock  $userPortfolioStock
     * @return \Illuminate\Http\Response
     */
    public function show(UserPortfolioStock $userPortfolioStock)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserPortfolioStock  $userPortfolioStock
     * @return \Illuminate\Http\Response
     */
    public function edit(UserPortfolioStock $userPortfolioStock)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserPortfolioStock  $userPortfolioStock
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserPortfolioStock $userPortfolioStock)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserPortfolioStock  $userPortfolioStock
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserPortfolioStock $userPortfolioStock)
    {
        //
    }
}
