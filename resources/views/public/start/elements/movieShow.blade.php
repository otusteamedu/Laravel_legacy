@if (count($showingMovies) > 0)
    <div class="movie-list i-iblock">
        <div class="i-title"><span class="">В прокате</span></div>
        <div class="container-fluid">
            <div class="row">
                @foreach ($showingMovies as $item)
                    <div class="col-sm-4 my-3">
                        <div class="card">
                            <a href="{{ route('public.movies.view', ['id' => $item['id']]) }}" style="background-image: url({{ asset($item['poster_thumb_url']) }})" class="card-img-top image"></a>
                            <div class="card-body">
                                <h5 class="card-title">
                                    <a href="{{ route('public.movies.view', ['id' => $item['id']]) }}">
                                        {{ $item['name'] }}
                                    </a>
                                </h5>
                                <a class="btn btn-primary shadow" href="{{ route('public.movies.order', ['id' => $item['id']]) }}" role="button">Купить билет</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif
