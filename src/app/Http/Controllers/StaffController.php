<?php

namespace App\Http\Controllers;

class StaffController extends Controller
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
     * Страница персонала
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('staff.index');
    }
}
