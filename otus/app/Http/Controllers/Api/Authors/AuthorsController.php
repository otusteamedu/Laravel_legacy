<?php

namespace App\Http\Controllers\Api\Authors;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Policies\Abilities;
use App\Services\Authors\AuthorsService;
use Illuminate\Http\Request;

class AuthorsController extends Controller {

    /** @var  */
    private $authorsService;

    public function __construct(AuthorsService $authorsService) {
        $this->authorsService = $authorsService;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index() {
        $authors = $this->authorsService->getAll();
        return response()->json($authors);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request) {

        $this->validate($request, [
            'name' => 'required',
            'surname' => 'required'
        ]);

        $author = $this->authorsService->storeAuthor($request->all());
        return response()->json($author);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Author $author
     * @return \Illuminate\Http\Response
     */
    public function show(Author $author) {
        return response()->json($author);
    }

    /**
     * @param Request $request
     * @param Author $author
     */
    public function update(Request $request, Author $author) {
        $this->authorsService->updateAuthor($author, $request->all());
        return response()->json($author);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Author $author
     * @return \Illuminate\Http\Response
     */
    public function destroy(Author $author) {
        $this->authorsService->destroyAuthors([$author->id]);
        return response()->json([]);
    }
}
