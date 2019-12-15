<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\Models\Grammar;
use App\Services\Grammar\GrammarService;
use Cache;

class GrammarController extends Controller
{
    private $grammarRepositoryCache;
    public function __construct(
        GrammarRepositoryCache $grammarRepositoryCache
    )
    {
        $this->grammarRepositoryCache = $grammarRepositoryCache;
    }
    public  function getList()
    {
        $list= $this->grammarService->listGrammar();
        return view('list')->with(['list'=>$list]);
    }
    public  function getDeatail(string $id)
    {
        $list= $this->grammarRepositoryCache->listGrammar();
        $detail=  $this->gramgrammarRepositoryCachemarService->detailGrammar($id);
        return  view('grammar')->with(['detail'=>$detail,'list'=>$list]);
    }
}
