<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the profile of user.
     *
     * @return Renderable
     */
    public function index(): Renderable
    {
        return view('profile');
    }
}
