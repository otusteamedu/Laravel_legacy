<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function list()
    {
        return view('pages.master.user.list');
    }

    public function create()
    {
        return view('pages.master.user.create');
    }

    public function detail()
    {
        return view('pages.master.user.detail');
    }

    public function edit()
    {
        return view('pages.master.user.edit');
    }

    public function createRecord()
    {
        return view('pages.master.record.create');
    }
}
