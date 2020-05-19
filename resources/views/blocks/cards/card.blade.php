<div class="card">
    @isset($image)
    <div class="card-image">
        <img src="{{ $image }}">
        <span class="card-title black">{{ $title }}</span>
    </div>
    @endisset
    <div class="card-content">
        @empty($image)
        <span class="card-title">{{ $title }}</span>
        @endempty
        <p>{!!   $text !!}</p>
    </div>
    @isset($links)
    <div class="card-action">
        @foreach ($links as $link)
            <a href="{{$link['url']}}">{{ $link['text'] }}</a>
        @endforeach

    </div>
        @endisset
</div>