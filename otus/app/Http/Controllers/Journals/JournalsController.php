<?php

namespace App\Http\Controllers\Journals;

use App\Models\Journal;
use App\Policies\Abilities;
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index() {

        /** @noinspection PhpUnhandledExceptionInspection */
        $this->authorize(Abilities::VIEW_ANY, Journal::class);

        return \view('journals.list', [
            'journals' => $this->journalService->searchJournals()
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create() {

        /** @noinspection PhpUnhandledExceptionInspection */
        $this->authorize(Abilities::CREATE, Journal::class);


        return view('journals.create', [
            'users' => $this->userService->searchUsers(),
            'statuses' => $this->handbookService->searchHandbooks(),
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Request $request) {

        /** @noinspection PhpUnhandledExceptionInspection */
        $this->authorize(Abilities::CREATE, Journal::class);

        /** @noinspection PhpUnhandledExceptionInspection */
        $this->validate($request, [
            'user_id' => 'required',
            'status_id' => 'required',
        ]);

        $this->journalService->storeJournal($request->all());
        return redirect(route('admin.journals.index'), 301);
    }

    /**
     * @param Journal $journal
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Journal $journal) {

        /** @noinspection PhpUnhandledExceptionInspection */
        $this->authorize(Abilities::VIEW, $journal);

        return view('journals.show', [
            'journal' => $journal
        ]);
    }

    /**
     * @param Journal $journal
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */

    public function edit(Journal $journal) {

        /** @noinspection PhpUnhandledExceptionInspection */
        $this->authorize(Abilities::UPDATE, $journal);

        return view('journals.edit', [
            'journal' => $journal,
            'users' => $this->userService->searchUsers(),
            'statuses' => $this->handbookService->searchHandbooks(),
        ]);
    }

    /**
     * @param Request $request
     * @param Journal $journal
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */

    public function update(Request $request, Journal $journal) {

        /** @noinspection PhpUnhandledExceptionInspection */
        $this->authorize(Abilities::UPDATE, $journal);

        $this->journalService->updateJournal($journal, $request->all());
        return redirect(route('admin.journals.index'), 301);
    }

    /**
     * @param Journal $journal
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */

    public function destroy(Journal $journal) {

        /** @noinspection PhpUnhandledExceptionInspection */
        $this->authorize(Abilities::DELETE, $journal);

        $this->journalService->destroyJournal([$journal->id]);
    }
}
