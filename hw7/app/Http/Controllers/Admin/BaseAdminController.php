<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaseAdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getAdminBreadcrumbs()
    {

        $breadcrumbs = [
            [
                'url' => route('admin.index'),
                'title' => __('messages.admin_panel'),
            ],

        ];

        return $breadcrumbs;
    }
}
