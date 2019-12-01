<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\Models\Grammar;
use App\Services\Grammar\GrammarService;
use Cache;

class GrammarController extends Controller
{
    private $grammarService;
    public function __construct(
        GrammarService $grammarService
    )
    {
        $this->grammarService = $grammarService;
    }
    public  function getList()
    {
        $list  = Cache::tags(['list'])->remember('grammar_list', 600, function () {
            return $this->grammarService->listGrammar();
        });
        return view('list')->with(['list'=>$list]);
    }

    public  function getDeatail(string $id)
    {
        $list  = Cache::tags(['list'])->remember('grammar_list', 600, function () {
            return $this->grammarService->listGrammar();
        });
        $detail  = Cache::tags(['grammar'])->remember('grammar_detail_'.$id, 600, function () use($id) {
            return  $this->grammarService->detailGrammar($id);
        });

        return  view('grammar')->with(['detail'=>$detail,'list'=>$list]);
    }
}
