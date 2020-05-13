<?php


namespace App\Services\Constructions\Handlers;

use App\Models\Construction;
use App\Services\Constructions\Repositories\ConstructionRepositoryInterface;

class CreateConstructionHandler
{
    private $constructionRepository;

    public function __construct(
        ConstructionRepositoryInterface $constructionRepository
    )
    {
        $this->constructionRepository = $constructionRepository;
    }

    /**
     * @param array $data
     * @return Construction
     */

    public function handle(array $data): Construction
    {
        return $this->constructionRepository->createFromArray($data);
    }
}
