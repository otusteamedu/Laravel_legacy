<?php

namespace App\Services\Films\Handlers;

use App\Models\Film;
use App\Services\Films\Repositories\EloquentFilmRepository;
use Illuminate\Database\Eloquent\Collection;

class IndexFilmHandler
{
    private $filmRepository;

    public function __construct(
        EloquentFilmRepository $filmRepository
    ) {
        $this->filmRepository = $filmRepository;
    }

    /**
     * @param array $data
     * @return array
     */
    public function handle(): array
    {
        $films = $this->filmRepository->index();

        foreach ($films as $item) {
            $allFilms[] = [
                "id"=>$item->id,
                "title"=>$item->title,
                "meta_title"=>$item->meta_title,
                "meta_description"=>$item->meta_description,
                "keywords"=>$item->keywords,
                "slug"=>$item->slug,
                "status"=>$item->status,
                "content"=>$item->content,
                "year"=>$item->year,
                "genres"=>$item->genres
            ];
        }
        
        return $allFilms;
    }
}