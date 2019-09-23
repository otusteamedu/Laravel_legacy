@if(count($menu) > 0)
<ul class="nav flex-column">
    @foreach ($menu as $item)
    <li class="nav-item">
        <a class="nav-link @if($item['active']) active @endif" href="{{ $item['href'] }}">
            @isset($item['icon'])
            <i class="fas fa-{{ $item['icon'] }}" aria-hidden="true"></i>
            @endisset
            <span>{{ $item['text'] }}</span>
        </a>
        @isset($item['items'])
            @include('admin.elements.menu', ['menu' => $item['items'], 'depth' => $depth + 1 ])
        @endisset
    </li>
    @endforeach
</ul>
@endif
