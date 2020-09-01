<?php


namespace App\Http\Controllers;


use App\Services\Adverts\AdvertsService;
use Illuminate\Http\Request;
use Auth;

class LkController
{
    private $advertsService;
    private $cookieController;

    public function __construct(AdvertsService $advertsService, CookieController $cookieController)
    {
        $this->advertsService = $advertsService;
        $this->cookieController = $cookieController;

    }

    public function index(Request $request)
    {
        $headerData = $this->advertsService->getHeaderData($request);
        $userAdverts = $this->advertsService->getUserAdverts(Auth::id());
        $userInfo = $this->advertsService->getUserInfo(Auth::id());

        return view('home.lk',
            [
                'advertList' => $userAdverts,
                'user_info' => $userInfo,
                'town_id'=>$headerData['town_id'],
                'townList' => $headerData['townList'],
                'divisionList' =>  $headerData['divisionList'],
            ]);
    }

}

