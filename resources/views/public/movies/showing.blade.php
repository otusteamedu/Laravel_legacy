@extends('public.movies.layout')

@php
    $breadCrumbs = [
        [
            'url' => \route('public.start'),
            'title' => __('public.menu.home'),
        ], [
            'url' => \route('public.movies.search'),
            'title' => __('public.menu.showing'),
        ], [
            'url' => \route('public.movies.view', ['id' => $movie['id']]),
            'title' => $movie['name'],
        ], [
            'url' => \route('public.movies.showing', ['id' => $movie['id']]),
            'title' => __('public.showings'),
        ]
    ];
@endphp

@section('pageTitle')
    {{ $movie['name'] }}: сеансы
@endsection

@section('pageHeader')
    {{ $movie['name'] }}: сеансы
@endsection

@section('pageContentMain')
    <div class="i-title"><span>Выбрать сеанс</span></div>
    <div class="container-fluid movie-showing-list i-iblock">
        <div class="row align-items-start m-0">
            <div class="col-md-6 cinema p-0 py-3"></div>
            <div class="col-md-6 cinema p-0 py-3">
                <form action="" method="get" class="">
                    <div class="i-content container-fluid">
                        <div class="row">
                            <label for="datetimepicker2" class="col-sm-3 px-0 col-form-label">Выбрать дату</label>
                            <div class="form-group col-sm-6">
                                <div class="input-group date shadow" id="datetimepicker2" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker2" role="date" placeholder="Дата" value="{{ $filter_date }}"/>
                                    <div class="input-group-append" data-target="#datetimepicker2" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-sm-3 px-0">
                                <input type="submit" value="Найти" class="btn btn-primary shadow" />
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        @if (count($moviesShowing) > 0)
            @foreach ($moviesShowing as $item)
                <div class="row align-items-start m-0">
                    <div class="col-md-6 cinema p-0 py-3">
                        <div class="container-fluid cinema-item i-iblock p-0">
                            <div class="row align-items-start">
                                <div class="col-4 col-md-2 image p-0">
                                    <a title="{{ $item['cinema']['name'] }}" href="{{ route('public.cinemas.item', ['id' => $item['cinema']['id']]) }}"></a>
                                </div>
                                <div class="col-8 col-md-10 desc">
                                    <div class="name">
                                        <a href="{{ route('public.cinemas.item', ['id' => $item['cinema']['id']]) }}">{{ $item['cinema']['name'] }}</a>
                                    </div>
                                    <div class="text">
                                        {{ $item['cinema']['address'] }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 showings desc p-0 py-3">
                        @foreach ($item['showings'] as $showing)
                            <a class="btn btn-warning shadow mb-2" href="{{ route('public.movies.order', ['id' => $showing['id']]) }}" role="button" target="_blank">
                                {{ $showing['time'] }}
                            </a>
                        @endforeach
                    </div>
                </div>
            @endforeach
        @else
            <div class="px-2 py-5 text-center">Нет доступных сеансов</div>
        @endif
    </div>
    <br /><br />
    <div class="container-fluid">
        <a class="btn btn-primary shadow" href="{{ route('public.movies.view', ['id' => $movie['id']]) }}" role="button">
            О фильме
        </a>
        <a class="btn btn-primary shadow" href="{{ route('public.movies.search') }}" role="button">
            Вернуться
        </a>
    </div>
@endsection
