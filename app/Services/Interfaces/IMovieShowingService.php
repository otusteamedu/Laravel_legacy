<?php


namespace App\Services\Interfaces;

use App\Base\Service\IBaseService;
use App\Models\Cinema;
use App\Models\Movie;
use App\Models\MovieShowing;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

interface IMovieShowingService extends IBaseService
{
    public function getMovieShowings(Carbon $date, Movie $movie, bool $checkDate = true): array;
    public function getCinemaShowings(Carbon $date, Cinema $cinema, bool $checkDate = true): array;
    public function ShowingIsExpired(MovieShowing $showing): bool;
    public function IsValid(MovieShowing $showing): bool;
}
