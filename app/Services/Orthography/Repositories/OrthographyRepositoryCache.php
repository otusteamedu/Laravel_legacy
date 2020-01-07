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
        return Cache::tags(['list'])->remember('grammar_list', 600, function () {
            return $this->orthographyRepository->list();
        });
    }

    public function detail($id)
    {
        return Cache::tags(['grammar'])->remember('grammar_detail_' . $id, 600, function () use ($id) {
            return $this->orthographyRepository->detail($id);
        });
    }
}
