<?php

namespace App\Services\Grammar;

use App\Models\Grammar;
use App\Services\Grammar\Repositories\GrammarRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class GrammarService
{

    private $grammarRepository;

    public function __construct(GrammarRepository $grammarRepository)
    {
        $this->grammarRepository = $grammarRepository;
    }

    public function listGrammar()
    {
        return $this->grammarRepository->listGrammar();
    }

    public function detailGrammar(string $id)
    {
        return $this->grammarRepository->detailGrammar($id);
    }
    public function updateGrammar($data)
    {
        return $this->grammarRepository->updateGrammar($data);
    }
    public function insertGrammar($data)
    {
        return $this->grammarRepository->insertGrammar($data);
    }

    public function newGrammar()
    {
        return new Grammar();
    }


}
