<nav class="level">
    <div class="level-left">
        <div class="level-item">
            <h1 class="title">{{ $head_text }}</h1>
        </div>
    </div>
    <div class="level-right">
        <div class="level-item">
            {{ link_to_route('podcasts.index', __('podcast.to_list'), [], ['class' => 'is-size-7']) }}
        </div>
    </div>
</nav>
