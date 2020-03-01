<?php

namespace App\Http\Controllers\Cms\Post\Comment;

use App\Http\Controllers\Cms\Post\Comment\Requests\UpdateCommentRequest;
use App\Models\Post\Comment;
use App\Policies\Abilities;
use App\Services\Cms\Post\CommentsService;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Cms\CurrentUser;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

/**
 * Class CommentsController
 * @package App\Http\Controllers\Cms\Post\Comment
 */
class CommentsController extends Controller
{
    use CurrentUser;

    /** @var CommentsService $commentsService */
    protected $commentsService;

    /**
     * CommentsController constructor.
     * @param CommentsService $commentsService
     */
    public function __construct(CommentsService $commentsService)
    {
        $this->commentsService = $commentsService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Factory|View
     */
    public function index(Request $request)
    {
        $this->checkAbility($request, Abilities::VIEW_ANY, Comment::class);

        return view('cms.comment.index', [
            'comments' => $this->commentsService->paginationList(),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param Comment $comment
     * @return Factory|View
     */
    public function show(Request $request, Comment $comment)
    {
        $this->checkAbility($request, Abilities::VIEW, $comment);

        return view('cms.comment.show', ['comment' => $comment]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateCommentRequest  $request
     * @param Comment $comment
     * @return RedirectResponse|Redirector
     */
    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        $this->checkAbility($request, Abilities::PUBLISHED, $comment);

        $data = $request->getFormData();

        $url = $this->commentsService->update($comment, $data);

        return redirect($url);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param Comment $comment
     * @return RedirectResponse|Redirector
     */
    public function destroy(Request $request, Comment $comment)
    {
        $this->checkAbility($request, Abilities::DELETE, $comment);

        $url = $this->commentsService->destroy($comment);

        return redirect($url);
    }
}
