<?php


namespace App\Http\Controllers\Subscriptions;


use App\Services\Subscriptions\SublistService;
use Illuminate\Http\Request;

class MainController
{
    private $sublistServise;

    public function __construct(SublistService $sublistService)
    {
        $this->sublistServise = $sublistService;
    }

    public function index()
    {
        return view('subscription.index');
    }

    public function write(Request $request)
    {
       $data = $request->except('_token');
       $this->sublistServise->SaveResult($data['email']);
    }

    public function checkWrite()
    {
        return $this->sublistServise->GetResult();
    }
}
