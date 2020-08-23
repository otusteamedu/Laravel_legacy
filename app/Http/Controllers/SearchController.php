<?php


namespace App\Http\Controllers;


use App\Models\Division;
use App\Services\Adverts\AdvertsService;

class SearchController extends Controller
{

    /**
     * @var AdvertsService
     */
    private $advertService;

    public function __construct(AdvertsService $advertService)
    {
        $this->advertService = $advertService;
    }

    public function division(\Request $request, $division, $town='all')
    {

        $divisionList = $this->advertService->showDivisionList();
        $townList = $this->advertService->showTownList();
        $pages = $this->advertService->filteredPage(8, $division, $town);

        $division = Division::find($division); // TODO убрать в сервис
        //$town = $request->cookie('town');

        return view('home.division',
            [
                'pages' => $pages,
                'divisionList' => $divisionList,
                'townList' => $townList,
                'town_id' => $town,
                'division'=>$division,
        ]);

    }



}
