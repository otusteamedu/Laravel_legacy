<?php


namespace App\Http\Controllers;


class StatisticController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Статистика
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('statistic.index');
    }
}
