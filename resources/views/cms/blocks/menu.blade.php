<ul class="{{$class}}">
@foreach($items as $item)
  @include('cms.blocks.item-menu', ['item' => $item])
@endforeach
</ul>