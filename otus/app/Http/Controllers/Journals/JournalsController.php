<?php

namespace App\Http\Controllers\Journals;

use App\Models\Journal;
use App\Services\Handbooks\HandbookService;
use App\Services\Journals\JournalService;
use App\Services\Users\UserService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class JournalsController extends Controller {

    protected $journalService;
    protected $userService;
    protected $handbookService;

    public function __construct(JournalService $journalService, UserService $userService, HandbookService $handbookService) {
        $this->journalService = $journalService;
        $this->userService = $userService;
        $this->handbookService = $handbookService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return \view('journals.list', [
            'journals' => $this->journalService->searchJournals()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('journals.create', [
            'users' => $this->userService->searchUsers(),
            'statuses' => $this->handbookService->searchHandbooks(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $this->journalService->storeJournal($request->all());
        return redirect(route('admin.journals.index'), 301);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Journal $journal
     * @return \Illuminate\Http\Response
     */
    public function show(Journal $journal) {
        return view('journals.show', [
            'journal' => $journal
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Journal $journal
     * @return \Illuminate\Http\Response
     */
    public function edit(Journal $journal) {
        return view('journals.edit', [
            'journal' => $journal,
            'users' => $this->userService->searchUsers(),
            'statuses' => $this->handbookService->searchHandbooks(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Journal $journal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Journal $journal) {
        $this->journalService->updateJournal($journal, $request->all());
        return redirect(route('admin.journals.index'), 301);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Journal $journal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Journal $journal) {
        $this->journalService->destroyJournal([$journal->id]);
    }
}
