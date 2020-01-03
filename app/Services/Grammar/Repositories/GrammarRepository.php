<?php

namespace App\Services\Grammar\Repositories;

use App\Http\Resources\GrammarResource;
use App\Models\Grammar;
use DB;
use Cache;


class GrammarRepository implements IGrammarRepository
{

    public function listGrammar()
    {
        return Grammar::all('id', 'name', 'code');
    }
    public function detailGrammar(int $id)
    {
        return Grammar::find($id);
    }

    public function updateGrammar(Grammar $grammar, Array $data):Grammar
    {
        $grammar->update($data);
        Cache::tags(['grammar'])->put('grammar_detail_' . $grammar->id, $data,600);
        return $grammar;
    }

    public function insertGrammar(Array $data):Grammar
    {
        $grammar = new Grammar();
        $gr= $grammar->create($data);
        Cache::tags(['grammar'])->put("grammar_detail_{$gr->id}", $gr,600);
        return $gr;
    }
}
