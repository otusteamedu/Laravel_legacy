<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Services\Portal\Post\PostsService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Class IndexController
 * @package App\Http\Controllers
 */
class IndexController extends Controller
{
    /** @var PostsService $postService */
    protected $postService;

    /**
     * IndexController constructor.
     * @param PostsService $postsService
     */
    public function __construct(PostsService $postsService)
    {
        $this->postService = $postsService;
    }

    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return Factory|View
     */
    public function show(Request $request)
    {
        return view('portal.index', [
            'posts' => $this->postService->getLastList(),
        ]);
    }
}
