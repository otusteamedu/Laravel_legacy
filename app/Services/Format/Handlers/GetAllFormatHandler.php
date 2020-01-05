<?php


namespace App\Services\Format\Handlers;

use App\Services\Format\Repositories\FormatRepository;
use Illuminate\Database\Eloquent\Collection;

class GetAllFormatHandler
{
    /**
     * @var FormatRepository
     */
    private $repository;

    /**
     * GetAllCategoryHandler constructor.
     * @param FormatRepository $repository
     */
    public function __construct(FormatRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return Collection
     */
    public function handle(): Collection {
        return $this->repository->getAll();
    }
}
