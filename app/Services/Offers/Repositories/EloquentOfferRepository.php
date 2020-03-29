<?php

namespace App\Services\Offers\Repositories;

use App\Models\Offer;
use Illuminate\Database\Eloquent\Builder;

class EloquentOfferRepository implements OfferRepositoryInterface
{
    public function find(int $id)
    {
        return Offer::find($id);
    }

    public function search(array $filters = [])
    {
        $query = Offer::query();
        $this->applyFilters($query, $filters);
        return $query->paginate();
    }

    public function createFromArray(array $data): Offer
    {
        $offer = new Offer();
        $offer->create($data);
        return $offer;
    }

    public function updateFromArray(Offer $offer, array $data)
    {
        $offer->update($data);
        return $offer;
    }

    private function applyFilters(Builder $builder, array $filters)
    {
        if (isset($filters['name'])) {
            $builder->where('name', $filters['name']);
        }
    }
}
