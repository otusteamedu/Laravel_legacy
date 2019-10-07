<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware("auth");
    }

    public function index()
    {

        $breadcrumbs = [
            [
                'url' => '/admin',
                'title' => __('messages.admin_panel'),
            ],

        ];

        return view('admin.dashboard.index', [
            'breadcrumbs' => $breadcrumbs,
        ]);
    }
}
