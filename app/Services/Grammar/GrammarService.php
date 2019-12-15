<?php

namespace App\Services\Grammar;

use App\Models\Grammar;
use App\Services\Grammar\Repositories\GrammarRepositoryCache;


class GrammarService
{

    private $grammarRepositoryCache;

    public function __construct(GrammarRepositoryCache $grammarRepositoryCache)
    {
        $this->grammarRepositoryCache = $grammarRepositoryCache;
    }

    public function listGrammar()
    {
        return $this->grammarRepositoryCache->listGrammar();
    }

    public function detailGrammar(string $id)
    {
        return $this->grammarRepositoryCache->detailGrammar($id);
    }
    public function updateGrammar(Grammar $grammar, Array $data):Grammar
    {
        return $this->grammarRepositoryCache->updateGrammar($grammar,$data);
    }
    public function insertGrammar($data):Grammar
    {
        return $this->grammarRepositoryCache->insertGrammar($data);
    }

    public function newGrammar()
    {
        return new Grammar();
    }
}
