<?php


namespace App\Services\Grammar\Repositories;

use Cache;

class GrammarRepositoryCache implements IGrammarRepositoryCache
{
    private $grammarRepository;

    public function __construct(
        GrammarRepository $grammarRepository
    )
    {
        $this->grammarRepository = $grammarRepository;
    }

    public function listGrammar()
    {
        return Cache::tags(['list'])->remember('grammar_list', 600, function () {
            return $this->grammarRepository->listGrammar();
        });
    }

    public function detailGrammar($id)
    {
        return Cache::tags(['grammar'])->remember('grammar_detail_' . $id, 600, function () use ($id) {
            return $this->grammarRepository->detailGrammar($id);
        });
    }
}
