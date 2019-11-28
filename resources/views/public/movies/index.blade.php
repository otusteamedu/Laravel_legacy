@extends('public.movies.layout')

@section('pageTitle')
    Фильмы в прокате
@endsection

@section('pageHeader')
    Фильмы в прокате
@endsection

@section('pageContentMain')
    @include('public.elements.filter')
    @if (count($showingMovies) > 0)
        <div class="movie-list i-iblock container-fluid">
            <div class="row">
                @foreach ($showingMovies as $item)
                    <div class="col-sm-4 my-3">
                        <div class="card">
                            <a href="{{ route('public.movies.info', ['id' => $item['id']]) }}" style="background-image: url({{ asset($item['poster']) }})" class="card-img-top image"></a>
                            <div class="card-body">
                                <h5 class="card-title">
                                    <a href="{{ route('public.movies.info', ['id' => $item['id']]) }}">
                                        {{ $item['name'] }}
                                    </a>
                                </h5>
                                <a class="btn btn-primary shadow" href="{{ route('public.movies.order', ['id' => $item['id']]) }}" role="button">Купить билет</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <nav aria-label="Фильмы в прокате">
                <ul class="pagination">
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item" aria-current="page">
                        <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#">След.</a>
                    </li>
                </ul>
            </nav>
        </div>
    @endif

@endsection

@section('pageContentRight')
@endsection
