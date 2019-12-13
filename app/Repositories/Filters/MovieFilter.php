<?php


namespace App\Repositories\Filters;


use App\Base\Repository\BaseFilter;
use App\Base\Service\Q;
use App\Helpers\Types;
use App\Helpers\Views\AdminHelpers;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class MovieFilter extends BaseFilter
{
    private $renJoined = false;

    public function apply(Q $query): Builder {
        parent::apply($query);

        foreach ($query->filter as $key => $value) {
            // пустые значения не участвуют в поиске
            if(empty($value))
                continue;

            switch ($key) {
                case 'name':
                    $exact = isset($query->filter['name_exact']) && $query->filter['name_exact'];
                    $this->filerName($value, $exact);
                    break;
                case 'genreId':
                    $this->filterGenre($value);
                    break;
                case 'countryId':
                    $this->filterCountry($value);
                    break;
                case 'cinemaId':
                    $this->filterCinema($value);
                    break;
                case 'rentalDate':
                    if($value instanceof Carbon) {
                        $rentalDateTo = (isset($query->filter['rentalDateTo'])
                            && ($query->filter['rentalDateTo'] instanceof Carbon)) ?
                            $query->filter['rentalDateTo'] : null;
                        $this->filterRentalDate($value, $query->filter['rentalDateTo']);
                    }

            }
        }

        return $this->builder;
    }
    private function joinRental(): self {
        if(!$this->renJoined) {
            $this->renJoined = true;
            $this->builder
                ->join('movie_rentals', 'movies.id', '=', 'movie_rentals.movie_id');
        }
        return $this;
    }
    private function filerName(string $value, bool $exact): self {
        if($exact)
            $this->builder->where('movies.name', $value);
        else
            $this->builder->where('movies.name', 'like', '%'.$value.'%');
        return $this;
    }

    private function filterCinema($cinemaId): self {
        $this->joinRental();
         if (Types::IsInt($cinemaId))
            $this->builder->where('movie_rentals.cinema_id', $cinemaId);

        return $this;
    }
    /**
     * При фильтрации учитываем неявную фильтрацию по дате - учитываем только фильмы, идущие в прокате
     * @param Carbon $date
     * @param Carbon|null $dateTo
     * @return $this
     */
    private function filterRentalDate(Carbon $date, Carbon $dateTo = null): self {
        $dbf = AdminHelpers::FORMAT_SITE_DATE_TIME;

        // защита от дурака. Если фильм не в прокате, то выведется пустой список
        $this->joinRental()->builder
            ->where('movie_rentals.date_end_at', '<=', Carbon::now()->format($dbf));

        if($date->gte($dateTo))
            $dateTo = null;
        if($dateTo == null) {
            $this->builder
                ->where('movie_rentals.date_start_at', '<=', $date->format($dbf))
                ->where('movie_rentals.date_end_at', '>=', $date->format($dbf));
        }
        else {
            $this->builder
                ->where('movie_rentals.date_start_at', '<=', $dateTo->format($dbf))
                ->where('movie_rentals.date_end_at', '>=', $date->format($dbf));
        }

        return $this;
    }
    /**
     * @param int|array $genreId
     * @return $this
     */
    private function filterGenre($genreId): self {
        $this->builder
            ->join('movie_genre', 'movies.id', '=', 'movie_genre.movie_id');
        if (Types::IsIntArray($genreId))
            $this->builder->whereIn('movie_genre.genre_id' , $genreId);
        else if (Types::IsInt($genreId))
            $this->builder->where('movie_genre.genre_id', $genreId);

        return $this;
    }

    private function filterCountry($countryId): self {
        $this->builder
            ->join('movie_country', 'movies.id', '=', 'movie_country.movie_id');
        if (Types::IsIntArray($countryId))
            $this->builder->whereIn('movie_country.country_id', $countryId);
        else if (Types::IsInt($countryId))
            $this->builder->where('movie_country.country_id', $countryId);

        return $this;
    }

}
