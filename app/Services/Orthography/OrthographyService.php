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
        $this->orthographyRepositoryCache= $orthographyRepositoryCache;
    }

    public function list()
    {
        return $this->orthographyRepositoryCache->list();//  Orthography::all('id', 'name');
    }


    public function detail($id):Orthography
    {
        return $this->orthographyRepository->detail($id);
    }
    public function update(Orthography $orthography, Array $data ,Array $file=[])
    {
        return $this->orthographyRepository->update($orthography,$data,$file);
    }
}
