<?php

namespace App\Services\Offers\Repositories;

use App\Models\Offer;

interface OfferRepositoryInterface
{

    public function find(int $id);

    public function search(array $filters = []);

    public function createFromArray(array $data): Offer;

    public function updateFromArray(Offer $offer, array $data);

}
