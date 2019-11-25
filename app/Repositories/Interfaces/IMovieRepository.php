<?php


namespace App\Repositories\Interfaces;

use App\Base\Repository\IBaseRepository;
use App\Models\File;
use App\Models\Movie;
use Illuminate\Database\Eloquent\Collection;

interface IMovieRepository extends IBaseRepository
{
    public function getAgeLimits(): array;

    public function getAvailProducers(): Collection;

    public function getAvailActors(): Collection;

    public function getAvailCountries(): Collection;

    public function getAvailGenres(): Collection;

    public function getSoonInRentail(): Collection;

    public function detachPoster(Movie $movie): ?File;
}
