<?php


namespace App\Http\Controllers;


use App\Services\Adverts\AdvertsService;
use App\Services\Adverts\SearchAdvertsService;
use App\Services\Divisions\DivisionsService;
use App\Services\Header\HeaderService;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    const PAGE_QTY = 8;
    /**
     * @var AdvertsService
     * @var SearchAdvertsService
     * @var CookieController
     * @var DivisionsService
     * @var HeaderService
     */
    private $advertService;
    private $searchAdvertsService;
    private $cookieController;
    private $divisionsService;
    private $headerService;

    public function __construct(
        AdvertsService $advertService,
        SearchAdvertsService $searchAdvertsService,
        CookieController $cookieController,
        DivisionsService $divisionsService,
        HeaderService $headerService
    ) {
        $this->advertService = $advertService;
        $this->searchAdvertsService = $searchAdvertsService;
        $this->cookieController = $cookieController;
        $this->divisionsService = $divisionsService;
        $this->headerService = $headerService;
    }

    public function division(Request $request, $division, $town='all')  //TODO обозвать по нормальному "DivisionFilter"
    {
        $headerData = $this->headerService->getHeaderData($request);
        $pages = $this->searchAdvertsService->filteredPage(self::PAGE_QTY, $division, $town);

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
        $pages = $this->searchAdvertsService->fullTextSearchAdverts($request, self::PAGE_QTY);

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
