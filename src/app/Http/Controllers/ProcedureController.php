<?php

namespace App\Http\Controllers;

class ProcedureController extends Controller
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
     * Список процедур
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('procedures.index');
    }
}
