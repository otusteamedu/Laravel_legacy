@if (count($premierMovies) > 0)
<div class="premier-slider i-iblock">
    <div class="i-title"><a href="{{ route('public.movies.premier') }}" class="badge badge-warning">Скоро в прокате!</a></div>
    <div id="carouselPremier" class="carousel slide" data-ride="carousel" data-interval="5000">
        <ol class="carousel-indicators">
            @foreach ($premierMovies as $item)
            <li data-target="#carouselPremier" data-slide-to="{{ $loop->index }}"@if ($loop->first) class="active"@endif></li>
            @endforeach
        </ol>
        <div class="carousel-inner">
            @foreach ($premierMovies as $item)
            <div class="carousel-item @if ($loop->first) active @endif">
                <a class="item clearfix" href="{{ route('public.movies.info', ['id' => $item['id']]) }}">
                    <div class="image" style="background-image: url({{ asset($item['poster']) }});"></div>
                    <div class="desc bg-secondary">
                        <div class="desc-in">
                            <div class="name">{{ $item['name'] }}</div>
                            <div class="date">Премьера {{ $item['premiereDate']->format('d.m.Y') }}</div>
                            <div class="age-limit">{{ $item['ageLimit'] }}</div>
                            <div class="text">{{ $item['slogan'] }}</div>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
        @if (count($premierMovies) > 1)
        <a class="carousel-control-prev" href="#carouselPremier" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Назад</span>
        </a>
        <a class="carousel-control-next" href="#carouselPremier" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Вперед</span>
        </a>
        @endif
    </div>
</div>
@endif
