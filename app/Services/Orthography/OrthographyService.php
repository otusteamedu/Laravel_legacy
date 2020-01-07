<?php


namespace App\Services\Orthography;


use App\Models\Orthography;
use App\Services\Orthography\Repositories\OrthographyRepository;
use App\Services\Orthography\Repositories\OrthographyRepositoryCache;

class OrthographyService
{
    private $orthographyRepository;
    private $orthographyRepositoryCache;

    public function __construct(
        OrthographyRepository $orthographyRepository,
        OrthographyRepositoryCache $orthographyRepositoryCache)
    {
        $this->orthographyRepository = $orthographyRepository;
        $this->orthographyRepositoryCache = $orthographyRepositoryCache;
    }

    public function list()
    {
        return Orthography::all('id', 'name');
    }

    public function update(Orthography $orthography, Array $data)
    {
        return $orthography->update($data);
        //return $this->orthographyRepository->updateGrammar($orthography,$data);
    }
}
