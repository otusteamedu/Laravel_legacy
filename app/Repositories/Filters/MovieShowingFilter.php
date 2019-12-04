<?php


namespace App\Repositories\Filters;

use App\Base\Repository\BaseFilter;
use App\Base\Service\Q;
use App\Helpers\Views\AdminHelpers;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;

class MovieShowingFilter extends BaseFilter
{
    private $renJoined = false;

    public function apply(Q $query): Builder {
        parent::apply($query);
        $checkDate = Arr::exists($query->filter, 'check_active') &&
            AdminHelpers::isTrue($query->filter['check_active']);

        foreach ($query->filter as $key => $value) {
            // пустые значения не участвуют в поиске
            if(empty($value))
                continue;

            switch ($key) {
                case 'date':
                    if($value instanceof CarbonInterface)
                        $this->filterDate($value, $checkDate);
                    break;
                case 'movieId':
                    $value = (int) $value;
                    if($value > 0)
                        $this->joinRental()->filterMovie($value);
                    break;
                case 'cinemaId':
                    $value = (int) $value;
                    if($value > 0)
                        $this->joinRental()->filterCinema($value);
                    break;
            }
        }

        $this->builder->orderBy('movie_showings.datetime');

        return $this->builder;
    }

    private function joinRental(): self {
        if(!$this->renJoined) {
            $this->renJoined = true;
            $this->builder
                ->join('movie_rentals', 'movie_showings.movie_rental_id', '=', 'movie_rentals.id');
        }
        return $this;
    }
    private function filterDate(CarbonInterface $date, bool $checkDate): self {
        if(!$checkDate) {
            $date->floorDay();
            $dateTo = $date->clone()->addDay();
        }
        else {
            $dateTo = $date->clone()->floorDay()->addDay();
        }

        $this->builder
            ->where('movie_showings.datetime', '>=', $date->format('Y-m-d H:i:s'))
            ->where('movie_showings.datetime', '<', $dateTo->format('Y-m-d H:i:s'));

        return $this;
    }

    private function filterMovie(int $movieId): self {
        $this->builder->where('movie_rentals.movie_id', $movieId);
        return $this;
    }
    private function filterCinema(int $cinemaId): self {
        $this->builder->where('movie_rentals.cinema_id', $cinemaId);
        return $this;
    }
}
