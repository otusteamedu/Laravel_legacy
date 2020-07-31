<?php

namespace App\Http\Controllers;

class RecordController extends Controller
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
     * Страница просмотра записей (история)
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('records.index');
    }
}
