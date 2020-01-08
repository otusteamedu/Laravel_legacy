<?php

namespace App\Http\Controllers\Admin;

use App\Models\Word;
use App\Services\Grammar\GrammarService;
use Illuminate\Http\Request;
use App\Policies\Abilities;
use App\Http\Controllers\Controller;
use App\Services\Word\WordService;



class WordsController extends Controller
{
    protected $wordService;
    protected $grammarService;
    public function __construct(
        WordService $wordService,
        GrammarService $grammarService
    )
    {
        $this->wordService = $wordService;
        $this->grammarService = $grammarService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $words = $this->wordService->list();
        $listGrammar = $this->grammarService->listGrammar();
        return view('admin.words.words_page')->with([
            'words'=>$words,
            'listGrammar' => $listGrammar
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'ar_word' => 'required',
            'rus_word' => 'required',
            'word_type' => 'required'
        ]);
        $data = $request->all();
        $this->wordService->insert($data);
        return "<a href='/admin/words'><<<</a> Слово добавлено";
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Word  $word
     * @return \Illuminate\Http\Response
     */
    public function show(Word $word)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Word  $word
     * @return \Illuminate\Http\Response
     */
    public function edit(Word $word)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Word  $word
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Word $word)
    {
        $this->authorize(Abilities::UPDATE, $word);
        $request->validate([
            'ar_word' => 'required',
            'rus_word' => 'required',
            'word_type' => 'required'
        ]);
        $data = $request->all();
        $this->wordService->update($word, $data);
        return "<a href='/admin/words'><<<</a> Слово обновлено";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Word  $word
     * @return \Illuminate\Http\Response
     */
    public function destroy(Word $word)
    {
        //
    }
}
