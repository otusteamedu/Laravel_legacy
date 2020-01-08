<?php


namespace App\Repositories;


use App\Base\Repository\BaseRepository;
use App\Models\MovieShowing;
use App\Models\Place;
use App\Models\ShowingPrice;
use App\Models\Tariff;
use App\Repositories\Interfaces\IShowingPriceRepository;
use Illuminate\Database\Eloquent\Collection;

class ShowingPriceRepository extends BaseRepository implements IShowingPriceRepository
{
    /**
     * @param MovieShowing $movieShowing
     * @param Place $place
     * @return int
     * @throws \App\Base\WrongNamespaceException
     */
    public function getPrice(MovieShowing $movieShowing , Place $place): int {
        return $this->getPriceByTariff($movieShowing , $place->tariff);
    }
    /**
     * @param MovieShowing $movieShowing
     * @return Collection
     * @throws \App\Base\WrongNamespaceException
     */
    public function getShowingPrices(MovieShowing $movieShowing): Collection
    {
        return $this->getModel()->newQuery()
            ->where('movie_showing_id', $movieShowing->id)->get();
    }
    /**
     * @param MovieShowing $movieShowing
     * @param Tariff $tariff
     * @return int
     * @throws \App\Base\WrongNamespaceException
     */
    public function getPriceByTariff(MovieShowing $movieShowing , Tariff $tariff): int
    {
        /** @var ShowingPrice $result */
        $result = $this->getModel()->newQuery()
            ->where('movie_showing_id', $movieShowing->id)
            ->where('tariff_id', $tariff->id)->get()->first();
        return $result ? $result->value : 0;
    }
}
