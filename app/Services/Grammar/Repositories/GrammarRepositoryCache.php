<?php


namespace App\Services\Grammar\Repositories;


use App\Services\Grammar\GrammarService;

class GrammarRepositoryCache implements IGrammarRepositoryCache
{
    private $grammarService;
    public function __construct(
        GrammarService $grammarService
    ){
        $this->grammarService=$grammarService;
    }
    public function listGrammar()
    {
        return Cache::tags(['list'])->remember('grammar_list', 600, function () {
            return $this->grammarService->listGrammar();
        });
    }
    public function detailGrammar($id)
    {
        return  Cache::tags(['grammar'])->remember('grammar_detail_' . $id, 600, function () use ($id) {
            return $this->grammarService->detailGrammar($id);
        });
    }
}
