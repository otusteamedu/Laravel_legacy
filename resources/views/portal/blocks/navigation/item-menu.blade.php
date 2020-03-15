@if($item->isActive)
    <span class="{{$item->class}}">{{$item->title}}</span>
@else
    <a class="{{$item->class}} nav-link" href="{!! $item->url() !!}">{{$item->title}}</a>
@endif