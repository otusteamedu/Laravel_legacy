<?php


namespace App\Http\Controllers;


class MessageController extends Controller
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
     * Сообщения, чат
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('message.index');
    }
}
