<?php


namespace Tests\Generators;

/**
 * Class OfferGenerator
 * @package Tests\Generators
 */
class OfferGenerator
{
    /**
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|mixed
     */
    public function createOffer (array $data = [])
    {
        return factory(Offer::class)->create($data);
    }
}
