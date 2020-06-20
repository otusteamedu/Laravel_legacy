<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class PlannerController extends Controller
{
    public function index(Request $request)
    {
        return view('main.planner.index');
    }
}
