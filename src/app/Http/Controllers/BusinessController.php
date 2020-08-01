<?php


namespace App\Http\Controllers;


class BusinessController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Главная страница салона
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('business.index');
    }

    /**
     * Страница добавления салона
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View+
     */
    public function create()
    {
        $businessTypes = [];
        return view('business.create', [
            'businessTypes' => $businessTypes,
        ]);
    }
}
