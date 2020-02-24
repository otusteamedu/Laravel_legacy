<?php

namespace App\Http\Controllers\Cms\Post\Comment;

use App\Http\Controllers\Cms\Post\Comment\Requests\UpdateCommentRequest;
use App\Models\Post\Comment;
use App\Policies\Abilities;
use App\Services\Cms\Post\CommentsService;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Cms\CurrentUser;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
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
     * @return Factory|View
     * @throws AuthorizationException
     */
    public function index()
    {
        $this->authorize(Abilities::VIEW_ANY, Comment::class);

        return view('cms.comment.index', [
            'comments' => $this->commentsService->paginationList(),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param Comment $comment
     * @return Factory|View
     * @throws AuthorizationException
     */
    public function show(Comment $comment)
    {
        $this->authorize(Abilities::VIEW, $comment);

        return view('cms.comment.show', ['comment' => $comment]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateCommentRequest  $request
     * @param Comment $comment
     * @return RedirectResponse|Redirector
     * @throws AuthorizationException
     */
    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        $this->authorize(Abilities::PUBLISHED, $comment);

        $data = $request->getFormData();

        $url = $this->commentsService->update($comment, $data);

        return redirect($url);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Comment $comment
     * @return RedirectResponse|Redirector
     * @throws AuthorizationException
     */
    public function destroy(Comment $comment)
    {
        $this->authorize(Abilities::DELETE, $comment);

        $url = $this->commentsService->destroy($comment);

        return redirect($url);
    }
}
