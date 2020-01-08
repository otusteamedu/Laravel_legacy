<?php


namespace App\Http\Controllers\Traits;

use App\Services\Interfaces\ICinemaService;
use App\Services\Interfaces\IGenreService;
use Carbon\Carbon;
use Illuminate\Http\Request;

/**
 * Выбираем данные для фильтра
 */
trait FilterTrait
{
    /** @var IGenreService $genreService */
    protected $genreService;
    /** @var ICinemaService $cinemaService */
    protected $cinemaService;

    public function initFilterData(Request $request): array {
        $filter_date = $request->get('filter_date', '');
        $filter_genreId = $request->get('filter_genreId', '');
        $filter_cinemaId = $request->get('filter_cinemaId', '');
        $filter_premiere = $request->get('filter_premiere', '');

        $filter_genres = $this->genreService->availableGenres(Carbon::now());
        $filter_cinemas = $this->cinemaService->availableCinemas(Carbon::now());

        return compact(
            'filter_date',
            'filter_genreId',
            'filter_cinemaId',
            'filter_premiere',
            'filter_genres',
            'filter_cinemas'
        );
    }
}
