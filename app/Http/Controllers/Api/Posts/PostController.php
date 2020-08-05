<?php

namespace App\Http\Controllers\Api\Posts;

use App\DTOs\PostFilterDTO;
use App\Http\Controllers\Api\Posts\Requests\IndexPostRequest;
use App\Http\Controllers\Api\Posts\Requests\StorePostRequest;
use App\Http\Controllers\Api\Posts\Requests\UpdatePostRequest;
use App\Http\Controllers\Api\Posts\Resources\PostResource;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Services\Groups\GroupService;
use App\Services\Posts\PostService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

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
     * @return AnonymousResourceCollection
     * @throws \Exception
     */
    public function index(IndexPostRequest $request): AnonymousResourceCollection
    {
        $DTO = PostFilterDTO::fromArray($request->getFormData());
        $posts = $this->service->paginate($DTO);

        return PostResource::collection($posts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePostRequest $request
     * @return PostResource
     */
    public function store(StorePostRequest $request): PostResource
    {
        $post = $this->service->store($request->getFormData());
        $post->loadMissing([
            'groups',
            'producer',
            'producer.role',
        ]);

        return new PostResource($post);
    }

    /**
     * Display the specified resource.
     *
     * @param Post $post
     * @return PostResource
     */
    public function show(Post $post): PostResource
    {
        $post->loadMissing([
            'groups',
            'producer',
            'producer.role',
        ]);

        return new PostResource($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePostRequest $request
     * @param Post $post
     * @return PostResource
     */
    public function update(UpdatePostRequest $request, Post $post): PostResource
    {
        $post = $this->service->update($request->getFormData(), $post);
        $this->groupService->clearCache();
        $post->loadMissing([
            'groups',
            'producer',
            'producer.role',
        ]);

        return new PostResource($post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Post $post
     * @return Response
     */
    public function destroy(Post $post): PostResource
    {
        $this->service->delete($post);

        return new PostResource($post);
    }
}
