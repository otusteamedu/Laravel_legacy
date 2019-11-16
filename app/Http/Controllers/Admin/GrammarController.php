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
     * @param \App\Models\Grammar $grammar
     * @return \Illuminate\Http\Response
     */
    public function show(Grammar $grammar)
    {
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
        return view('admin.grammar_detail_create')->with(['grammar' => $grammar]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Grammar $grammar
     * @return \Illuminate\Http\Response
     */
    public function update(Grammar $grammar, Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'code' => 'required',
            'title' => 'required',
        ]);
        $request = $request->all();
        $id = $this->grammarService->updateGrammar($request);
        $message = '';
        $error = '';
        if ($id) {
            $message = 'ОК';
            $grammar = $this->grammarService->detailGrammar($id);
        } else {
            $error = 'Error';
        }
        return view('admin.grammar_detail')->with(['grammar' => $grammar, 'error' => $error, 'message' => $message]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'code' => 'required',
            'title' => 'required',
        ]);
        $request = $request->all();
        $id = $this->grammarService->insertGrammar($request);
        $message = '';
        $error = '';
        if ($id) {
            $message = 'ОК';
            $grammar = $this->grammarService->detailGrammar($id);
        } else {
            $error = 'Error';
        }
        return view('admin.grammar_detail')->with(['grammar' => $grammar, 'error' => $error, 'message' => $message]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Grammar $grammar
     * @return \Illuminate\Http\Response
     */
    public function edit(Grammar $grammar)
    {

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Grammar $grammar
     * @return \Illuminate\Http\Response
     */
    public function destroy(Grammar $grammar)
    {
        //
    }
}
