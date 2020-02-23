<nav class="nav breadcrumb p-2">
@foreach($items->items as $item)
    @if ($item->isActive || !$item->url())
        <span class="breadcrumb-item">{{ $item->title }}</span>
    @else
        <a href="{!! $item->url() !!}" class="breadcrumb-item">{{ $item->title }}</a>
    @endif
@endforeach
</nav>