<nav class="{{$class}}">
    @foreach($items as $item)
        @include('portal.blocks.navigation.item-menu', ['item' => $item])
    @endforeach
</nav>