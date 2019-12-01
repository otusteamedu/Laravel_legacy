<?php

namespace App\Http\Controllers\Authors;

use App\Models\Author;
use App\Policies\Abilities;
use App\Services\Authors\AuthorsService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthorsController extends Controller {

    protected $authorsService;

    public function __construct(AuthorsService $authorsService) {
        $this->authorsService = $authorsService;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index() {
        /** @noinspection PhpUnhandledExceptionInspection */
        $this->authorize(Abilities::VIEW_ANY, Author::class);

        return \view('authors.list', [
            'authors' => $this->authorsService->searchAuthors()
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create() {

        /** @noinspection PhpUnhandledExceptionInspection */
        $this->authorize(Abilities::CREATE, Author::class);

        return view('authors.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Request $request) {

        /** @noinspection PhpUnhandledExceptionInspection */
        $this->authorize(Abilities::CREATE, Author::class);

        $this->validate($request, [
            'name' => 'required',
            'surname' => 'required'
        ]);

        $this->authorsService->storeAuthor($request->all());
        return redirect(route('admin.authors.index'), 301);
    }

    /**
     * @param Author $author
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Author $author) {

        /** @noinspection PhpUnhandledExceptionInspection */
        $this->authorize(Abilities::VIEW, $author);

        return view('authors.show', [
            'author' => $author
        ]);
    }

    /**
     * @param Author $author
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Author $author) {
        /** @noinspection PhpUnhandledExceptionInspection */
        $this->authorize(Abilities::UPDATE, $author);
        return view('authors.edit', [
            'author' => $author
        ]);
    }

    /**
     * @param Request $request
     * @param Author $author
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, Author $author) {

        /** @noinspection PhpUnhandledExceptionInspection */
        $this->authorize(Abilities::UPDATE, $author);

        $this->authorsService->updateAuthor($author, $request->all());
        return redirect(route('admin.authors.index'), 301);
    }

    /**
     * @param Author $author
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Author $author) {

        /** @noinspection PhpUnhandledExceptionInspection */
        $this->authorize(Abilities::DELETE, $author);

        $this->authorsService->destroyAuthors([$author->id]);
    }
}
