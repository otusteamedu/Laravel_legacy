<?php


namespace App\Services\Format;


use App\Services\Format\Repositories\FormatRepository;
use Illuminate\Database\Eloquent\Collection;

class FormatService
{
    private FormatRepository $repository;

    /**
     * FormatService constructor.
     * @param FormatRepository $repository
     */
    public function __construct(FormatRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return Collection
     */
    public function index(): Collection
    {
        return $this->repository->index();
    }
}
