<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
//use App\Models\Grammar;
use App\Services\Grammar\GrammarService;

//use Cache;

class GrammarController extends Controller
{
    private $grammarService;

    public function __construct(
        GrammarService $grammarService
    )
    {
        $this->grammarService = $grammarService;
    }

    public function getList()
    {
        $list = $this->grammarService->listGrammar();
        return view('list')->with(['list' => $list]);
    }

    public function getDeatail(string $id)
    {

        $list = $this->grammarService->listGrammar();
        $detail = $this->grammarService->detailGrammar($id);

        return view('grammar')->with(['detail' => $detail, 'list' => $list]);
    }
}
