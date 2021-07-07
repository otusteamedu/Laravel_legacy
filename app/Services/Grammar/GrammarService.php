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

    public function list()
    {
        return $this->grammarRepositoryCache->list();
    }
    public function listGrammar()
    {
        $list=Grammar::all(['id', 'name']);
        foreach ($list as $l){
            $result[$l['id']]=$l['name'];
        }
        return $result;
    }

    public function detail(string $id)
    {
        return $this->grammarRepositoryCache->detail($id);
    }
    public function update(Grammar $grammar, Array $data):Grammar
    {
        return $this->grammarRepository->update($grammar,$data);
    }
    public function insert($data):Grammar
    {
        return $this->grammarRepository->insert($data);
    }

    public function new()
    {
        return new Grammar();
    }
    public function delete(Grammar $grammar)
    {
        return $this->grammarRepository->delete($grammar);
    }


}
