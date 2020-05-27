<?php
/**
 * @var \App\Models\Article $article
 * @var \App\Models\ArticleComment $comment
 */
?>
<div class="col-md-8 blog-main rounded box-shadow bg-white pt-3 border-top">
    <div class="bs-example">
        @foreach ($article->comments as $comment)
            <div class="media">
                <img src="{{$comment->user->avatar}}" class="rounded-circle mr-3" alt="Sample Image" height="40px">
                <div class="media-body">
                    <h5 class="mt-0">{{$comment->user->name}}<small><i> {{$comment->created_at}}</i></small></h5>
                    <p>{{$comment->text}}</p>
                </div>
            </div>
        @endforeach
    </div>
</div>
