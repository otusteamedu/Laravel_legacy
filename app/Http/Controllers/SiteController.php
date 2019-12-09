<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiteController extends Controller
{
    /**
     * Метод для главной страницы
     *
     */
    public function index()
    {
        return view('site.index');
    }

    /**
     * Метод для страницы "О нас"
     *
     */
    public function showAbout()
    {
        return view('site.about');
    }
}
