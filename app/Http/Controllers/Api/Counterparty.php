<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Counterparty\Repositories\CounterpartyRepositoryInterface;

class Counterparty extends Controller
{
    protected $repository;

    public function __construct(CounterpartyRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        return $this->repository->search();
    }

    public function show(\App\Models\Counterparty $counterparty)
    {
        return $counterparty;
    }
}
