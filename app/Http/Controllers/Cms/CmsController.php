<?php


namespace App\Http\Controllers\Cms;


use App\Http\Controllers\Controller;

class CmsController extends Controller
{

    public function index()
    {
        return view('cms.admin');
    }

}
