<?php

namespace App\Http\Controllers\Portal\Post;

use App\Http\Controllers\Controller;
use App\Services\Portal\Post\CommentsService;
use App\Services\Portal\Post\PostsService;
use App\Services\Portal\Post\RubricsService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PostController extends Controller
{
    /** @var PostsService $postsService */
    protected $postsService;

    /** @var RubricsService $rubricsService */
    protected $rubricsService;

    /** @var CommentsService  */
    protected $commentsService;

    /**
     * PostController constructor.
     * @param PostsService $postsService
     * @param RubricsService $rubricsService
     * @param CommentsService $commentsService
     */
    public function __construct(
        PostsService $postsService,
        RubricsService $rubricsService,
        CommentsService $commentsService
    )
    {
        $this->postsService = $postsService;

        $this->rubricsService = $rubricsService;

        $this->commentsService = $commentsService;
    }

    /**
     * @param Request $request
     * @return Factory|View
     */
    public function index(Request $request)
    {
        return view('portal.post.list', [
            'posts' => $this->postsService->getPostList($request)
        ]);
    }

    /**
     * @param Request $request
     * @return Factory|View
     */
    public function rubricList(Request $request)
    {
        $rubric = $this->rubricsService->getRubric($request);

        return view('portal.post.list', [
            'rubric' => $rubric,
            'posts' => $this->postsService->getRubricList($request, $rubric->id)
        ]);
    }

    /**
     * @param Request $request
     * @return Factory|View
     */
    public function show(Request $request)
    {
        $post = $this->postsService->getPost($request);
        return view('portal.post.post', [
            'post' => $post,
            'comments' => $this->commentsService->getList($post->id)
        ]);
    }
}
