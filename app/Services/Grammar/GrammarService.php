<?php

namespace App\Services\Grammar;

use App\Models\Grammar;
use App\Services\Grammar\Repositories\GrammarRepositoryCache;
use App\Services\Grammar\Repositories\GrammarRepository;


class GrammarService
{

    private $grammarRepositoryCache;
    private $grammarRepository;
    public function __construct(
        GrammarRepository $grammarRepository,
        GrammarRepositoryCache $grammarRepositoryCache)
    {
        $this->grammarRepository = $grammarRepository;
        $this->grammarRepositoryCache = $grammarRepositoryCache;
    }

    public function listGrammar()
    {
        return $this->grammarRepositoryCache->listGrammar();
    }
    public function list()
    {
        $list=Grammar::all(['id', 'name']);
        foreach ($list as $l){
            $result[$l['id']]=$l['name'];
        }
        return $result;
    }

    public function detailGrammar(string $id)
    {
        return $this->grammarRepositoryCache->detailGrammar($id);
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
