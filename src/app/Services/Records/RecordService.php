<?php

namespace App\Services\Records;

use App\Services\Records\Repositories\RecordRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class RecordService
{

    /**
     * @var RecordRepositoryInterface
     */
    private $repository;

    public function __construct(
        RecordRepositoryInterface $repository
    ) {
        $this->repository = $repository;
    }

    /**
     * Списк всех процедур для салона
     * @return Collection|null
     */
    public function getMyRecord(): ?Collection
    {
        return $this->repository->findByBusinessId(Auth::user()->business->id);
    }
}
