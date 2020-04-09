<?php


namespace App\Services\CDEK;


use App\Services\CDEK\Handlers\GetPriceHandler;
use App\Services\CDEK\Handlers\GetPVZSHandler;
use App\Services\CDEK\Handlers\GetSettlementsHandler;

class CDEKService
{
    private GetPVZSHandler $getPVZSHandler;
    private GetSettlementsHandler $getSettlementsHandler;
    private GetPriceHandler $getPriceHandler;

    /**
     * CDEKService constructor.
     * @param GetPVZSHandler $getPVZSHandler
     * @param GetSettlementsHandler $getSettlementsHandler
     * @param GetPriceHandler $getPriceHandler
     */
    public function __construct(
        GetPVZSHandler $getPVZSHandler,
        GetSettlementsHandler $getSettlementsHandler,
        GetPriceHandler $getPriceHandler
    )
    {
        $this->getPVZSHandler = $getPVZSHandler;
        $this->getSettlementsHandler = $getSettlementsHandler;
        $this->getPriceHandler = $getPriceHandler;
    }

    /**
     * @param array $requestData
     * @return array|null
     */
    public function getPVZS(array $requestData) {
        $query = $requestData['query'];

        return !empty($query)
            ? $this->getPVZSHandler->handle($query)
            : [];
    }

    /**
     * @param array $requestData
     * @return array
     */
    public function getSettlements(array $requestData) {
        $query = $requestData['query'];

        return !empty($query)
            ? $this->getSettlementsHandler->handle($query)
            : [];
    }

    /**
     * @param array $requestData
     * @return int
     */
    public function getPrice(array $requestData) {
        $query = $requestData['query'];

        return !empty($query)
            ? $this->getPriceHandler->handle($query)
            : 0;
    }
}
