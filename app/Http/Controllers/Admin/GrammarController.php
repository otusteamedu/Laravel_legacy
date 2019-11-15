<?php

namespace App\Http\Controllers\Admin;

use App\Models\Grammar;
use App\Services\Grammar\GrammarService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\String_;

class GrammarController extends Controller
{

    protected $grammarService;

    public function __construct(
        GrammarService $grammarService
    )
    {
      $this->grammarService = $grammarService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = $this->grammarService->listGrammar();
        return view('admin.grammar_list')->with(['list' => $list]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Grammar  $grammar
     * @return \Illuminate\Http\Response
     */
    public function show(string $grammar)
    {
        $grammar = $this->grammarService->detailGrammar($grammar);
        return view('admin.grammar_detail')->with(['grammar' => $grammar]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $grammar = $this->grammarService->newGrammar();
        return view('admin.grammar_detail')->with(['grammar' => $grammar]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Grammar  $grammar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request=$request->all();


            if(empty($request['id'])) {
                $grammar = $this->grammarService->createGrammar($request);
                if($grammar!==0)
                return view('admin.grammar_detail')->with(['grammar' => $grammar]);
            }else{
                $grammar = $this->grammarService->updateGrammar($request);
                if($grammar!==0)
                return view('admin.grammar_detail')->with(['grammar' => $grammar]);
            }
            return 'error';

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Grammar  $grammar
     * @return \Illuminate\Http\Response
     */
    public function edit(Grammar $grammar)
    {
        //
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Grammar  $grammar
     * @return \Illuminate\Http\Response
     */
    public function destroy(Grammar $grammar)
    {
        //
    }
}
