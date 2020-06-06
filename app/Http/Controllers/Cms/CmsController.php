<?php


namespace App\Http\Controllers\Cms;


use App\Http\Controllers\Controller;

class CmsController extends Controller
{

//    /**
//     * Create a new controller instance.
//     *
//     * @return void
//     */
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    public function index()
    {
        return view('cms.admin');
    }

}
