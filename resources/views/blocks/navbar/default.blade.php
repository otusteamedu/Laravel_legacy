<nav class="navbar navbar-expand-lg navbar-light bg-light">
    @isset($navbar['brand'])
        <a class="navbar-brand" href="{{ $navbar['brand']['url'] }}">{{ $navbar['brand']['name']  }}</a>
    @endif
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#{{ $navbar['id'] }}"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="{{ $navbar['id'] }}">
        <ul class="navbar-nav">
            @foreach ($navbar['list'] as $item)
                <li class="nav-item {{ $item['current'] ? 'active' : '' }}">
                    <a class="nav-link {{  $item['disabled'] ? 'disabled' : '' }}" href="{{$item['url']}}">{{$item['name']}}
                        @isset($item['current'])
                            <span class="sr-only">@lang('navbar.current')</span>
                        @endisset
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</nav>
