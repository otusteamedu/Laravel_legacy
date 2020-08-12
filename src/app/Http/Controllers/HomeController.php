<?php

namespace App\Http\Controllers;

use App\Services\Records\RecordService;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * @var RecordService
     */
    private $recordService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        RecordService $recordService
    )
    {
        $this->recordService = $recordService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::check()) {
            return redirect('/home');
        }

        return view('home.landing');
    }

    /**
     * Главная страница, зарегистрированный пользователь
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function home()
    {
        $records = $this->recordService->getMyRecord();

        return view('home.index', [
            'records' => $records
        ]);
    }
}
