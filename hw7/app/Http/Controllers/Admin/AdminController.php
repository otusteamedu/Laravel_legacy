<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends BaseAdminController
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $breadcrumbs = $this->getAdminBreadcrumbs();
        return view('admin.dashboard.index', [
            'breadcrumbs' => $breadcrumbs,
        ]);
    }
}
