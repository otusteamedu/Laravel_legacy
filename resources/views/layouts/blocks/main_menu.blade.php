<ul class="navbar-nav mr-auto">
    @foreach ($mainMenuItems as $item)
        <li class="nav-item">
            <a class="nav-link" href="{{ isset($item['route']) ? route($item['route']) : url($item['href']) }}">{{ $item['title'] }}</a>
        </li>
    @endforeach
</ul>
