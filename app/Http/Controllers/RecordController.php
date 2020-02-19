<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RecordController extends Controller
{
    public function list()
    {
        return view('pages.master.record.list');
    }

    public function edit()
    {
        return view('pages.master.record.edit');
    }
}
