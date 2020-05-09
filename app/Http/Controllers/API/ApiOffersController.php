<?php


namespace App\Http\Controllers\API;


use App\Services\Offers\OffersService;
use Illuminate\Http\Request;

class ApiOffersController
{
    const DEFAULT_LIMIT = 100;

    /**
     * @var OffersService
     */
    private $offersService;

    /**
     * ApiOffersController constructor.
     * @param OffersService $offersService
     */
    public function __construct(
        OffersService $offersService
    )
    {
        $this->offersService = $offersService;
    }

    /**
     * @param Request $request
     */
    public function list(Request $request)
    {
        $limit = $request->get('limit', self::DEFAULT_LIMIT);
        $offset = $request->get('offset', 0);

        $offers = $this->offersService->getOffers($limit, $offset);
    }
}
