<a href="{{$link ?? ''}}" class="badge d-flex align-items-center {{$slot}}">
    <span>{{$title}} </span>
    @if($count ?? false)
        <span class="badge badge-light">{{$count  }}</span>
    @endif
</a>
