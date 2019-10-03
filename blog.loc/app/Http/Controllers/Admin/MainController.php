<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MainController extends Controller
{
    public $template;
    public $data;

    public function renderOut()
    {
        return view($this->template)->with($this->data);
    }
}
