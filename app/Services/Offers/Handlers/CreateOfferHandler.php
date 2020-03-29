<?php


namespace App\Services\Offers\Handlers;


use App\Models\Offer;
use App\Services\Offers\Repositories\EloquentOfferRepository;

class CreateOfferHandler
{

    private $offerRepository;

    public function __construct(
        EloquentOfferRepository $offerRepository
    )
    {
        $this->offerRepository = $offerRepository;
    }

    /**
     * @param array $data
     * @return Offer
     */
    public function handle(array $data): Offer
    {
        return $this->offerRepository->createFromArray($data);
    }

}
