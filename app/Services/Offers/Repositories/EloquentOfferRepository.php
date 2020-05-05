<?php

namespace App\Services\Offers\Repositories;

use App\Models\Offer;
use Illuminate\Database\Eloquent\Builder;

class EloquentOfferRepository implements OfferRepositoryInterface
{
    /**
     * @param int $id
     * @return Offer|Offer[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     */
    public function find(int $id)
    {
        return Offer::find($id);
    }

    /**
     * @param array $filters
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function search(array $filters = [])
    {
        $query = Offer::query();
        $this->applyFilters($query, $filters);
        return $query->paginate();
    }

    /**
     * @param array $data
     * @return Offer
     */
    public function createFromArray(array $data): Offer
    {
        $offer = new Offer();
        $offer->create($data);
        return $offer;
    }

    /**
     * @param Offer $offer
     * @param array $data
     * @return Offer
     */
    public function updateFromArray(Offer $offer, array $data)
    {
        $offer->update($data);
        return $offer;
    }

    /**
     * @param Builder $builder
     * @param array $filters
     */
    private function applyFilters(Builder $builder, array $filters)
    {
        if (isset($filters['name'])) {
            $builder->where('name', $filters['name']);
        }
    }

    /**
     * @param int $limit
     * @param int $offset
     * @return Offer[]|Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getList(int $limit, int $offset)
    {
        $query = Offer::query();
        $query->limit($limit);
        $query->offset($offset);
        $query->remember(env('DEFAULT_CACHE_TTL', 0));

        return $query->get();
    }
}
