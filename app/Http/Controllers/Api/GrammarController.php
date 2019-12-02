<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\GrammarResource;
use App\Models\Grammar;
use App\Policies\Abilities;
use App\Services\Grammar\GrammarService;
use Illuminate\Http\Request;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Str;


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
        return response()->json($list);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Grammar $grammar
     * @return \Illuminate\Http\Response
     */
    public function show(Grammar $grammar)
    {
        return response()->json(new GrammarResource($grammar));
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
        $insert = $this->grammarService->insertGrammar($data);
        return response()->json(new GrammarResource($insert));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Grammar $grammar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Grammar $grammar)
    {
        $this->authorize(Abilities::UPDATE, $grammar);
        $updateData = $request->all();
        $updateData['id'] = $grammar->id;
        $update=$this->grammarService->updateGrammar($grammar,$updateData);
        return  response()->json(new GrammarResource($update));
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
