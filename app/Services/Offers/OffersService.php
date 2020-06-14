<?php


namespace App\Services\Offers;

use App\Models\Offer;
use App\Services\Offers\Handlers\CreateOfferHandler;
use App\Services\Offers\Repositories\OfferRepositoryInterface;
use App\Services\Offers\Repositories\CachedOfferRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;


class OffersService
{
    /** @var OfferRepositoryInterface */
    private $offerRepository;
    /** @var CachedOfferRepositoryInterface */
    private $cachedOfferRepository;
    /** @var CreateOfferHandler */
    private $createOfferHandler;

    public function __construct(
        CreateOfferHandler $createOfferHandler,
        OfferRepositoryInterface $offerRepository,
        CachedOfferRepositoryInterface $cachedOfferRepository
    )
    {
        $this->createOfferHandler = $createOfferHandler;
        $this->offerRepository = $offerRepository;
        $this->cachedOfferRepository = $cachedOfferRepository;
    }

    /**
     * @param array $data
     * @return Offer
     */
    public function storeOffer(array $data): Offer
    {
        return $this->createOfferHandler->handle($data);
    }


    /**
     * @param int $id
     * @return Offer|null
     */
    public function findOfferCached(int $id)
    {
        return $this->cachedOfferRepository->find($id);
    }

    /**
     * @param int $id
     * @return Offer|null
     */
    public function findOffer(int $id)
    {
        return $this->offerRepository->find($id);
    }

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function searchCachedOffers(): LengthAwarePaginator
    {
        return $this->cachedOfferRepository->search([], [
            'offers'
        ]);
    }


    /**
     * @param int $limit
     * @param int $offset
     * @return Collection
     */
    public function getOffers(int $limit, int $offset): Collection
    {
        return $this->offerRepository->getList($limit, $offset);
    }

}
