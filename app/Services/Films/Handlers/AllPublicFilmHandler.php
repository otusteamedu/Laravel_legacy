<?php

namespace App\Services\Films\Handlers;

use App\Models\Film;
use App\Services\Films\Repositories\EloquentFilmRepository;
use App\Services\Films\Repositories\CachedFilmRepositoryInterface;

class AllPublicFilmHandler
{
    /** @var EloquentFilmRepository */
    private $filmRepository;
    /** @var CachedFilmRepositoryInterface */
    private $cachedFilmRepository;

    public function __construct(
        EloquentFilmRepository $filmRepository,
        CachedFilmRepositoryInterface $cachedFilmRepository
    ) {
        $this->cachedFilmRepository = $cachedFilmRepository;
        $this->filmRepository = $filmRepository;
    }

    /**
     * @return array
    */
    public function publicAll(): array
    {
        $films = $this->filmRepository->index();
        $arPublic = [];
        foreach ($films as $item) {
            if ($item->status=='0') {
                $this->filmRepository->updateFromArray($item, ['status'=>'1']);
                $this->cachedFilmRepository->clearFilmCache($item);
                $arPublic[] = [
                    "id"=>$item->id,
                    "title"=>$item->title,
                    "slug"=>$item->slug,
                    "status"=>$item->status
                ];
            }
        }

        return $arPublic;
    }

    /**
     * @param array $data
     * @return array
    */
    public function publicByIds(array $data): array
    {
        $arResult = [];
        foreach($data as $id){
            $film = $this->filmRepository->find($id);
            $result = $this->filmRepository->updateFromArray($film, ['status'=>'1']);
            $this->cachedFilmRepository->clearFilmCache($result);
            $arResult[] = [
                "id"=>$result->id,
                "title"=>$result->title,
                "slug"=>$result->slug,
                "status"=>$result->status
            ];
        }

        return $arResult;
    }
}