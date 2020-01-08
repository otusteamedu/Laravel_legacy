<?php


namespace App\Services;


use App\Base\Service\BaseService;
use App\Repositories\GenreRepository;
use App\Services\Interfaces\IGenreService;
use Carbon\Carbon;

class GenreService extends BaseService implements IGenreService {

    public function availableGenres(Carbon $date_from , Carbon $date_to = null): array
    {
        /** @var GenreRepository $repository */
        $repository = $this->getRepository();
        return $repository->getList()->toArray();
    }
}
