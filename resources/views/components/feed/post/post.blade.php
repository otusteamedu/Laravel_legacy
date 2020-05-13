<div class="card post">
    <div class="card-header">
        @include('components.feed.post.components.header', ['author' => $post->author])
    </div>
    <div class="card-body">
        @include('components.feed.post.components.body', [$post])
    </div>
    <div class="card-footer">
        @include('components.feed.post.components.footer')
    </div>
</div>
