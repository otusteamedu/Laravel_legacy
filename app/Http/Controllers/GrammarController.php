<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
//use App\Models\Grammar;
use App\Services\Grammar\GrammarService;

//use App\Http\Controllers\Controller;

use App\Services\Cache\CacheService;


class GrammarController extends Controller
{
    protected $grammarService;

    public function __construct(
        GrammarService $grammarService
    )
    {
        $this->grammarService = $grammarService;
    }

    public function getList()
    {
        $list= $this->grammarService->listGrammar();
        return  view('list')->with(['list'=>$list]);
    }

    public  function getDeatail(string $id)
    {
        $list= $this->grammarService->listGrammar();
        $detail=  $this->grammarService->detailGrammar($id);
        return  view('grammar')->with(['detail'=>$detail,'list'=>$list]);
    }
}
