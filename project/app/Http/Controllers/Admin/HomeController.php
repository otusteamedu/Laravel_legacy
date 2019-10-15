<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

/**
 * Class HomeController main admin page
 * @package App\Http\Controllers\Admin
 */
class HomeController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.home');
    }
}
