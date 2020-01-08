<?php


namespace App\Services\Orthography\Repositories;

use App\Models\Orthography;
use Cache;

class OrthographyRepositoryCache implements IOrthographyRepositoryCache
{
    private $orthographyRepository;

    public function __construct(
        OrthographyRepository $orthographyRepository
    )
    {
        $this->orthographyRepository = $orthographyRepository;
    }

    public function list()
    {
        return Cache::tags(['list'])->remember('orthography_list', 600, function () {
            return $this->orthographyRepository->list();
        });
    }

    public function detail($id)
    {
        return Cache::tags(['orthography'])->remember('orthography_detail_' . $id, 600, function () use ($id) {
            return $this->orthographyRepository->detail($id);
        });
    }
}
