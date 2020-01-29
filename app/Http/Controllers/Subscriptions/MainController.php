<?php


namespace App\Http\Controllers\Subscriptions;


use Illuminate\Http\Request;

class MainController
{
    public function index()
    {
        return view('subscription.index');
    }

    public function write(Request $request)
    {
       $data = $request->except('_token');
       WriteFileController::writeFile($data);
    }
}
