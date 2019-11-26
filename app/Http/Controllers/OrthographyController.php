<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrthographyController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public static function getList(){
        return view('list');
    }
    public static function getDeatail($code){
        return view('orthography');
    }
}
