<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GrammarModel;
use DB;

class GrammarController extends Controller
{
    public static function getList()
    {
        $list = GrammarModel::getList();
        return view('list');
    }

    public static function getDeatail(string $code)
    {
        $detail = GrammarModel::getDetail($code);
        return view('garmmar');
    }
}
