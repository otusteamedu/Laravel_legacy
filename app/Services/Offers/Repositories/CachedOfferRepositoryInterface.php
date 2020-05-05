<?php


namespace App\Services\Offers\Repositories;

use App\Models\Offer;

interface CachedOfferRepositoryInterface
{

    public function search(array $filters = [], array $with = []);

    public function clearSearchCache();

    public function find(int $id);

    public function clearOfferCache(Offer $country);

}
