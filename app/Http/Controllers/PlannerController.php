<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class PlannerController extends Controller
{
    public function index(Request $request)
    {
        return view('planner.index');
    }

    public function gallery(Request $request)
    {
        return view('planner.gallery');
    }

    public function myProxy(Request $request)
    {
        return view('planner.my-proxy');
    }

    public function myAccounts(Request $request)
    {
        return view('planner.my-accounts');
    }
}
