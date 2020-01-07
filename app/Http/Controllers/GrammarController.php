<?php

namespace App\Http\Controllers;


use App\Services\Test\TestService;
use App\Services\Word\WordService;
use App\Services\Grammar\GrammarService;


class GrammarController extends Controller
{
    private $testService;
    private $wordService;
    private $grammarService;
    public function __construct(
        TestService $testService,
        WordService $wordService,
        GrammarService $grammarService
    )
    {
        $this->testService = $testService;
        $this->wordService = $wordService;
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
        $tests = $this->testService->detail($id);
        $words = $this->wordService->detail($id);
        return view('grammar')->with(
            [
                'detail' => $detail,
                'list' => $list,
                'tests' => $tests,
                'words' => $words
            ]);
    }
}
