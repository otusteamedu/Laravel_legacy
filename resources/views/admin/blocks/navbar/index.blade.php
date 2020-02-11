<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <a class="navbar-brand" href="<?=route('home')?>"><?= __('messages.main_page')?></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
            aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
            @foreach($links as $l)
                <li class="nav-item">
                    <a class="nav-link" href="{{$l['link']}}">{{$l['name']}}</a>
                </li>
            @endforeach
        </ul>
    </div>
</nav>