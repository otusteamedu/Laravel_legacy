<?php

namespace App\Http\Controllers\Admin\Index;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index()
    {
        return view('admin.index.page');
    }
}
