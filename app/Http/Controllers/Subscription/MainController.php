<?php


namespace App\Http\Controllers\Subscription;


use Illuminate\Http\Request;

class MainController
{
    public function index()
    {
        return view('subscription.index');
    }

    public function getForm(Request $request)
    {
        $data = $request->except('_token');
        $this->saveFile($data);
    }

    private function saveFile($data)
    {
        WriteFileForm::save($data);
    }

}
