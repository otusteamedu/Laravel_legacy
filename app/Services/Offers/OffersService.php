<?php


namespace App\Services\Offers;

use App\Models\Offer;
use App\Services\Offers\Handlers\CreateOfferHandler;
use App\Services\Offers\Repositories\OfferRepositoryInterface;


class OffersService
{
    private $offerRepository;
    private $createOfferHandler;

    public function __construct(
        CreateOfferHandler $createOfferHandler,
        OfferRepositoryInterface $offerRepository
    )
    {
        $this->createOfferHandler = $createOfferHandler;
        $this->offerRepository = $offerRepository;
    }

    /**
     * @param array $data
     * @return Offer
     */
    public function storeOffer(array $data): Offer
    {
        return $this->createOfferHandler->handle($data);
    }

}
