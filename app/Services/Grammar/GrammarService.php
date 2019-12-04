<?php

namespace App\Services\Grammar;

use App\Models\Grammar;
use App\Services\Grammar\Repositories\GrammarRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Http\Resources\GrammarResource;
use Illuminate\Http\Request;

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
    public function updateGrammar(Grammar $grammar, Array $data):Grammar
    {
        return $this->grammarRepository->updateGrammar($grammar,$data);
    }
    public function insertGrammar($data):Grammar
    {
        return $this->grammarRepository->insertGrammar($data);
    }

    public function newGrammar()
    {
        return new Grammar();
    }


}
