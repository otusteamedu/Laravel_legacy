<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    /**
     * HomeController constructor.
     */
    public function __construct()
    {
    }

    /**
     * Show the main page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('index');
    }

    public function about()
    {
        return view('about.index');
    }

    public function admin()
    {
        return view('admin.index');
    }

    public function personal()
    {
        $user = \Auth::user();

        return view('personal.index', ['user' => $user]);
    }
}
