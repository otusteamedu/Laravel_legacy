<?php


namespace App\Services\Grammar\Repositories;


interface IGrammarRepositoryCache
{
    public function listGrammar();
    public function detailGrammar(int $id);

}
