@extends('public.movies.layout')

@php
    $breadCrumbs = [
        [
            'url' => \route('public.start'),
            'title' => __('public.menu.home')
        ],  [
            'url' => \route('public.movies.search'),
            'title' => __('public.menu.showing')
        ]
    ]
@endphp

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
                            <a href="{{ route('public.movies.view', ['id' => $item['id']]) }}" style="background-image: url({{ asset($item['poster_thumb_url']) }})" class="card-img-top image"></a>
                            <div class="card-body">
                                <h5 class="card-title">
                                    <a href="{{ route('public.movies.view', ['id' => $item['id']]) }}">
                                        {{ $item['name'] }}
                                    </a>
                                </h5>
                                <a class="btn btn-primary shadow" href="{{ route('public.movies.showing', ['id' => $item['id']]) }}" role="button">Купить билет</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            {!! $navPages['html'] !!}
        </div>
    @endif

@endsection

@section('pageContentRight')
@endsection
