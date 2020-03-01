<?php

namespace App\Http\Controllers\Cms\Post\Post;

use App\Http\Controllers\Cms\CurrentUser;
use App\Http\Controllers\Cms\Post\Post\Requests\PublishedPostRequest;
use App\Http\Controllers\Cms\Post\Post\Requests\StorePostRequest;
use App\Http\Controllers\Cms\Post\Post\Requests\UpdatePostRequest;
use App\Models\Post\Post;
use App\Policies\Abilities;
use App\Services\Cms\Post\PostsService;
use App\Services\Cms\Post\RubricsService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

/**
 * Class PostsController
 * @package App\Http\Controllers\Cms\Post\Post
 */
class PostsController extends Controller
{
    use CurrentUser;

    /** @var PostsService $postService */
    protected $postsService;

    /** @var RubricsService $rubricsService */
    protected $rubricsService;

    protected $locale;

    public function __construct(PostsService $postsService, RubricsService $rubricsService)
    {
        $this->postsService = $postsService;
        $this->rubricsService = $rubricsService;
        $this->locale = \App::getLocale();
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Factory|View
     */
    public function index(Request $request)
    {
        $this->checkAbility($request, Abilities::VIEW_ANY, Post::class);

        return view('cms.post.index', [
            'posts' => $this->postsService->paginationList(),
            'locale' => $this->locale,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return Factory|View
     */
    public function create(Request $request)
    {
        $this->checkAbility($request, Abilities::CREATE, Post::class);

        return  view('cms.post.create', [
            'rubrics' => $this->rubricsService->getArrayList(),
            'locale' => $this->locale,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StorePostRequest  $request
     * @return RedirectResponse|Redirector
     */
    public function store(StorePostRequest $request)
    {
        $this->checkAbility($request, Abilities::CREATE, Post::class);

        $url = $this->postsService->store($request);

        return redirect($url);
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param Post $post
     * @return Factory|View
     */
    public function show(Request $request, Post $post)
    {
        $this->checkAbility($request, Abilities::VIEW, $post);

        return view('cms.post.show', [
            'post' => $post,
            'image' => $this->postsService->getPostImage($post),
            'locale' => $this->locale,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $request
     * @param Post $post
     * @return Factory|View
     */
    public function edit(Request $request, Post $post)
    {
        $this->checkAbility($request, Abilities::UPDATE, $post);

        return view('cms.post.edit', [
            'post' => $post,
            'rubrics' => $this->rubricsService->getArrayList(),
            'image' => $this->postsService->getPostImage($post),
            'locale' => $this->locale,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdatePostRequest  $request
     * @param Post $post
     * @return RedirectResponse|Redirector
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $this->checkAbility($request, Abilities::UPDATE, $post);

        $url = $this->postsService->update($post, $request);

        return redirect($url);
    }

    /**
     * Published the specified resource in storage.
     *
     * @param PublishedPostRequest  $request
     * @param Post $post
     * @return RedirectResponse|Redirector
     */
    public function published(PublishedPostRequest $request, Post $post)
    {
        $this->checkAbility($request, Abilities::PUBLISHED, $post);

        $data = $request->getFormData();

        $url = $this->postsService->published($post, $data);

        return redirect($url);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param Post $post
     * @return RedirectResponse|Redirector
     */
    public function destroy(Request $request, Post $post)
    {
        $this->checkAbility($request, Abilities::DELETE, $post);

        $url = $this->postsService->destroy($post);

        return redirect($url);
    }
}
