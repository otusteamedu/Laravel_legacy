<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class SiteController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        return view('main.index');
    }
}
