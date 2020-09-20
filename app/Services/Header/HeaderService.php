<?php


namespace App\Services\Header;


use App\Http\Controllers\CookieController;
use App\Services\Adverts\ItemsDTO;
use App\Services\Divisions\Repositories\DivisionRepositoryInterface;
use App\Services\Towns\Repositories\TownRepositoryInterface;

class HeaderService
{

    /**
     * @var DivisionRepositoryInterface
     * @var TownRepositoryInterface
     * @var CookieController
     */
    private $divisionRepository;
    private $townRepository;
    private $cookieController;

    public function __construct(
        DivisionRepositoryInterface $divisionRepository,
        TownRepositoryInterface $townRepository,
        CookieController $cookieController
    ) {

        $this->divisionRepository = $divisionRepository;
        $this->townRepository = $townRepository;
        $this->cookieController = $cookieController;
    }

    public function showDivisionList()
    {
        $division =$this->divisionRepository->list();
        return ItemsDTO::make($division);
    }

    public function showTownList()
    {
        $town = $this->townRepository->list();
        return ItemsDTO::make($town);
    }

    public function getHeaderData($request)  //TODO закешить
    {
        return
            [
                'divisionList' => $this->showDivisionList(),
                'townList' => $this->showTownList(),
                'town_id'  => $this->cookieController->getCookieTownId($request),
            ];

    }
}
