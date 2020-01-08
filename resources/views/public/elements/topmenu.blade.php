<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
</button>
@php
    $menu = [
        [
            'href' => route('public.start'),
            'text' => __('public.menu.home')
        ], [
            'href' => route('public.about'),
            'text' => __('public.menu.about')
        ], [
            'href' => route('public.movies.search'),
            'text' => __('public.menu.showing')
        ], [
            'href' => route('public.cinemas.index'),
            'text' => __('public.menu.cinemas')
        ], [
            'href' => '#',
            'text' => __('public.menu.reviews')
        ]
    ];
@endphp

<div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
        @php
            $len = 0;
            $index = -1;
            foreach($menu as $i => $item) {
                $menu[$i]['active'] = false;
                if(strpos(url()->current(), $item['href']) === 0) {
                    if(strlen($item['href']) > $len) {
                        $len = strlen($item['href']);
                        $index = $i;
                    }
                }
            }
            if($index >= 0)
                $menu[$index]['active'] = true;
        @endphp
        @foreach($menu as $item)
        <li class="nav-item @if($item['active']) active @endif">
            <a class="nav-link" href="{{ $item['href'] }}">{{ $item['text'] }}</a>
        </li>
        @endforeach
    </ul>
</div>

