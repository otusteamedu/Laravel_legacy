<?php


namespace App\Http\Controllers;


use App\Models\Division;
use App\Services\Adverts\AdvertsService;
use App\Services\Divisions\DivisionsService;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    const PAGE_QTY = 8;
    /**
     * @var AdvertsService
     * @var CookieController
     */
    private $advertService;
    private $cookieController;
    private $divisionsService;

    public function __construct(AdvertsService $advertService,
                                CookieController $cookieController,
                                DivisionsService $divisionsService)
    {
        $this->advertService = $advertService;
        $this->cookieController = $cookieController;
        $this->divisionsService = $divisionsService;
    }

    public function division(Request $request, $division, $town='all')
    {
        $headerData = $this->advertService->getHeaderData($request);
        $pages = $this->advertService->filteredPage(self::PAGE_QTY, $division, $town);

        $division = $this->divisionsService->getSelectedDivision($division); //TODO взять из divisionList

        return view('home.division',
            [
                'pages' => $pages,
                'divisionList' => $headerData['divisionList'],
                'townList' => $headerData['townList'],
                'town_id' => $town,
                'division'=>$division,
        ]);

    }

    public function mainSearch(Request $request)
    {
        $headerData = $this->advertService->getHeaderData($request);
        //$pages = $this->advertService->searchAdverts($request);
        $pages=$this->advertService->fullTextSearchAdverts($request, self::PAGE_QTY);

        return view('home.search',
            [
                'pages' => $pages,
                'divisionList' => $headerData['divisionList'],
                'townList' => $headerData['townList'],
                'town_id'=> $headerData['town_id'],
                'division_id' => $request->division_id,
                'text' => $request->text,
            ]);
    }

}
