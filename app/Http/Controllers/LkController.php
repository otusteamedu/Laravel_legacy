<?php


namespace App\Http\Controllers;


use App\Services\Adverts\AdvertsService;
use App\Services\Header\HeaderService;
use Illuminate\Http\Request;
use Auth;

class LkController
{
    private $advertsService;
    private $cookieController;
    private $headerService;

    public function __construct(
        AdvertsService $advertsService,
        CookieController $cookieController,
        HeaderService $headerService
    ) {
        $this->advertsService = $advertsService;
        $this->cookieController = $cookieController;

        $this->headerService = $headerService;
    }

    public function index(Request $request)
    {
        $headerData = $this->headerService->getHeaderData($request);
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

