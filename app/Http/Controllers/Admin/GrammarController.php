<?php

namespace App\Http\Controllers\Admin;

use App\Models\Grammar;
use App\Models\Test;
use App\Services\Grammar\GrammarService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use App\Policies\Abilities;
use App\Jobs\UpdateGrammarJob;
use Illuminate\Support\Facades\Log;
use App\User;

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
        $message="";
        $test=Test::where(['lessen_id'=>$grammar->id,'status'=>0])->get();
        return view('admin.grammar_detail')->with(
            [
                'grammar' => $grammar,
                'message' => $message,
                'test' => $test
            ]);
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
        $this->authorize(Abilities::UPDATE, $grammar);
        $request->validate([
            'name' => 'required',
            'code' => 'required',
            'title' => 'required',
        ]);

        $data = $request->all();
        $grammar = $this->grammarService->updateGrammar($grammar,$data);
        $this->dispatch(new UpdateGrammarJob($grammar->id,Auth::User()->id));
        return view('admin.grammar_detail')->with([
            'grammar' => $grammar,
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'code' => 'required',
            'title' => 'required',
        ]);
        $data = $request->all();
        $grammar = $this->grammarService->insertGrammar($data);
        $message = '';
        $error = '';

        return view('admin.grammar_detail')->with([
            'grammar' => $grammar,
            'error' => $error,
            'message' => $message
        ]);
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
