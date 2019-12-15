<?php


namespace App\Services\Grammar\Repositories;


use App\Models\Grammar;

interface IGrammarRepository
{
    public function listGrammar();
    public function detailGrammar(int $id);
    public function updateGrammar(Grammar $grammar, Array $data):Grammar;
    public function insertGrammar(Array $data):Grammar;

}
