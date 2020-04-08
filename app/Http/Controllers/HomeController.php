<?php

namespace App\Http\Controllers;

use App\Services\Locales\LocalesService;

class HomeController extends Controller
{
    private $localesService;

    /**
     * HomeController constructor.
     */
    public function __construct(LocalesService $localesService)
    {
        $this->localesService = $localesService;
    }

    /**
     * Show the main page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('index');
    }

    public function about()
    {
        return view('about.index');
    }

    public function admin()
    {
        return view('admin.index');
    }

    public function personal()
    {
        $user = \Auth::user();

        return view('personal.index', ['user' => $user]);
    }

    public function setLocale(string $locale = '') {
        $this->localesService->setUserLocale($locale);

        return redirect()->back();
    }
}
