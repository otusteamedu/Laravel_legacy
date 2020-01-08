<?php

namespace App\Http\Controllers\Admin;

//use App\Model\Test;
use Illuminate\Http\Request;
use App\Models\Test;
use App\Http\Controllers\Controller;
use App\Services\Test\TestService;
use App\Services\Grammar\GrammarService;
use App\Policies\Abilities;

class TestsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $testService;
    protected $grammarService;
    public function __construct(
        TestService $testService,
        GrammarService $grammarService
    )
    {
        $this->testService = $testService;
        $this->grammarService = $grammarService;
    }

    public function index()
    {
        $tests = $this->testService->listTest();
        $listGrammar = $this->grammarService->listGrammar();
        return view('admin.tests.test_list_page')->with([
            'tests' => $tests,
            'listGrammar'=>$listGrammar
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Test $test)
    {
        $this->authorize(Abilities::UPDATE, $test);
        $request->validate([
            'name' => 'required',
            'text' => 'required',
            'lessen_id' => 'required'
        ]);
        $data = $request->all();
        $this->testService->updateTest($test, $data);
        return "<a href='/admin/tests'><<<</a> Тест обновлен";
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
            'name' => 'required',
            'text' => 'required',
            'lessen_id' => 'required'
        ]);
        $data = $request->all();
        $test = $this->testService->insert($data);
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
     * Display the specified resource.
     *
     * @param  \App\Model\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function show(Test $test)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function edit(Test $test)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function destroy(Test $test)
    {
        //
    }
}
