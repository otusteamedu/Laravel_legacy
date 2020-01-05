<nav class="navbar{{$class}}">
    @foreach($pages as $page)
        @if($page['is_active'])
            <span class="nav-item">{{$page['name']}}</span>
        @else
            <a class="nav-item nav-link" href="{{$page['slug']}}">{{$page['name']}}</a>
        @endif
    @endforeach
</nav>