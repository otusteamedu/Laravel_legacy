<?php

namespace App\Http\Controllers\Posts;

use App\DTOs\PostFilterDTO;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Posts\Requests\IndexPostRequest;
use App\Http\Controllers\Posts\Requests\StorePostRequest;
use App\Http\Controllers\Posts\Requests\UpdatePostRequest;
use App\Models\Post;
use App\Services\Groups\GroupService;
use App\Services\Helpers\Ability;
use App\Services\Posts\PostService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class PostController extends Controller
{
    /**
     * @var PostService
     */
    private $service;
    /**
     * @var GroupService
     */
    private $groupService;

    /**
     * PostController constructor.
     * @param PostService $service
     * @param GroupService $groupService
     */
    public function __construct(PostService $service, GroupService $groupService)
    {
        parent::__construct();

        $this->service = $service;
        $this->groupService = $groupService;
        $this->authorizeResource(Post::class, 'post');
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexPostRequest $request
     * @return View
     */
    public function index(IndexPostRequest $request): View
    {
        $DTO = PostFilterDTO::fromArray($request->getFormData());
        $posts = $this->service->paginate($DTO);
        $titles = $this->service->getTableTitles();
        $filter = $DTO->toArray();
        $groups = $this->groupService->groupSelectList(Auth::user()->role);

        return view('posts.index', compact('posts', 'titles', 'filter', 'groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        $groups = $this->groupService->groupSelectList(Auth::user()->role);

        return view('posts.create', compact('groups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePostRequest $request
     * @return RedirectResponse
     */
    public function store(StorePostRequest $request): RedirectResponse
    {
        $post = $this->service->store($request->getFormData());

        return redirect()->route('posts.show', $post)
            ->with(['success' => __('messages.success_save')]);
    }

    /**
     * Display the specified resource.
     *
     * @param Post $post
     * @return View
     */
    public function show(Post $post): View
    {
        return view('posts.view', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Post $post
     * @return View
     */
    public function edit(Post $post): View
    {
        $groups = $this->groupService->groupSelectList(Auth::user()->role);

        return view('posts.edit', compact('post', 'groups'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePostRequest $request
     * @param Post $post
     * @return RedirectResponse
     */
    public function update(UpdatePostRequest $request, Post $post): RedirectResponse
    {
        $this->service->update($request->getFormData(), $post);
        $this->groupService->clearCache();

        return redirect()->route('posts.show', $post)
            ->with(['success' => __('messages.success_update')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Post $post
     * @return RedirectResponse
     */
    public function destroy(Post $post): RedirectResponse
    {
        $this->service->delete($post);

        return redirect()->route('posts.index')
            ->with(['success' => __('messages.success_delete')]);
    }

    /**
     * @param Post $post
     * @return RedirectResponse
     */
    public function send(Post $post): RedirectResponse
    {
        Gate::authorize(Ability::SEND, $post);
        $post = $this->service->send($post);

        return redirect()->route('posts.show', $post)
            ->with(['success' => __('messages.success_send')]);
    }
}
