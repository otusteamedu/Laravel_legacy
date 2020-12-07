<?php

namespace App\Http\Controllers\Crm;

use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CrmController extends Controller
{
    public function index()
    {
        $layout = $this->layout();

        return view('crm.' . $layout, ['layout' => 'crm.layouts.nav_' . $layout]);
    }

    public function layout()
    {
        $user = Auth::user();

        if ($user->hasRole('admin')) {
            $layout = 'admin';
        }

        if ($user->hasRole('client')) {
            $layout = 'client';
        }

        if ($user->hasRole('manager')) {
            $layout = 'manager';
        }

        return !empty($layout) ? $layout : 'default';

    }
}
