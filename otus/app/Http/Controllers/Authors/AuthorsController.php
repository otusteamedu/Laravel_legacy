<?php

namespace App\Http\Controllers\Authors;

use App\Models\Author;
use App\Services\Authors\CategoryService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthorsController extends Controller {

    protected $authorsService;

    public function __construct(CategoryService $authorsService) {
        $this->authorsService = $authorsService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        return \view('authors.list', [
            'authors' => $this->authorsService->searchAuthors()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('authors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $this->authorsService->storeAuthor($request->all());
        return redirect(route('admin.authors.index'), '301');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function show(Author $author) {
        return view('authors.show', [
            'author' => $author
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function edit(Author $author) {
        return view('authors.edit', [
            'author' => $author
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Author $author) {
        $this->authorsService->updateAuthor($author, $request->all());
        return redirect(route('admin.authors.index'), '301');
    }

    /**
     * @param Author $author
     */
    public function destroy(Author $author) {
        $this->authorsService->destroyAuthors([$author->id]);
    }
}
