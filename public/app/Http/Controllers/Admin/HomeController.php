<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $view = view('admin/home')->render();

        return (new Response($view));
    }
}
