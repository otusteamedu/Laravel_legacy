<div class="comment-list">
    <?php /** @var \App\Models\Post\Comment $comment */ ?>
    @foreach($comments[$path] as $comment)
        <div class="comment">
            <p>{{$comment->user->name}}</p>
            <p>{{$comment->content}}</p>
            @if(isset($comments[$comment->id]))
                @include('portal.post.blocks.comments', [
                    'comments' => $comments,
                    'path' => $comment->id,
                ])
            @endif
        </div>
    @endforeach
</div>