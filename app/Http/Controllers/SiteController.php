<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class SiteController
{
    /**
     * @return View
     */
    public function index(): View
    {
        return view('main.index');
    }
}
