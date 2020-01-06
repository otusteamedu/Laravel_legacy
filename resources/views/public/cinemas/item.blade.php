@extends('public.cinemas.layout')

@php
    $breadCrumbs = [
        [
            'url' => \route('public.start'),
            'title' => __('public.menu.home'),
        ], [
            'url' => \route('public.cinemas.index'),
            'title' => __('public.menu.cinemas'),
        ], [
            'url' => \route('public.cinemas.item', ['id' => $cinema['id']]),
            'title' => $cinema['name'],
        ]
    ];
@endphp

@section('pageTitle')
    {{ $cinema['name'] }}: информация о кинотеатре
@endsection

@section('pageHeader')
    Кинотеатр &laquo;{{ $cinema['name'] }}&raquo;
@endsection

@section('pageContentMain')
    <ul class="properties">
        <li>
            <span class="p-name">Адрес:</span>
            <span class="p-value">
                {{ $cinema['address'] }}
            </span>
        </li>
    </ul>

    <div class="container-fluid cinema-detail i-iblock">

    </div>

    <div class="container-fluid movie-showing-list i-iblock">
        <div class="row align-items-start m-0">
            <div class="col-md-4 cinema p-0 py-3">
                <h4>Выбрать сеанс</h4>
            </div>
            <div class="col-md-8 cinema p-0 py-3">
                <form action="" method="get" class="">
                    <div class="i-content container-fluid">
                        <div class="row">
                            <label for="datetimepicker2" class="col-sm-3 px-0 col-form-label">Выбрать дату</label>
                            <div class="form-group col-sm-6">
                                <div class="input-group date shadow" id="datetimepicker2" data-target-input="nearest">
                                    <input name="filter_date" type="text" class="form-control datetimepicker-input" data-target="#datetimepicker2" role="date" placeholder="Дата" value="{{ $filter_date }}"/>
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
                    <div class="col-md-7 cinema p-0 py-3">
                        <div class="container-fluid cinema-item i-iblock p-0">
                            <div class="row align-items-start">
                                <div class="col-3 image p-0">
                                    <a title="{{ $item['movie']['name'] }}" href="{{ route('public.movies.view', ['id' => $item['movie']['id']]) }}" style="background-image: url({{ asset($item['photo_thumb_url']) }})"></a>
                                </div>
                                <div class="col-9 desc">
                                    <div class="name">
                                        <a href="{{ route('public.movies.view', ['id' => $item['movie']['id']]) }}">{{ $item['movie']['name'] }}</a>
                                    </div>
                                    <div class="text">
                                        @if (count($item['movie']['genres']) > 0)
                                            @foreach($item['movie']['genres'] as $value)
                                                {{ $value['name'] }}@if (!$loop->last), @endif
                                            @endforeach
                                            <br/>
                                        @endif
                                        <small>
                                            @if ($item['movie']['age_limit'] > 0)
                                                Ограничение: {{ $item['movie']['age_limit'] }}+<br/>
                                            @endif
                                            @if ($item['movie']['duration'] > 0)
                                                Длительность: {{ $item['movie']['duration'] }} мин.
                                            @endif
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 showings desc p-0 py-3">
                        @foreach ($item['showings'] as $showing)
                            <a class="btn btn-warning shadow mb-2" href="{{ route('public.movies.order', ['id' => $showing['id']]) }}" role="button" target="_blank">
                                {{ $showing['time'] }}
                            </a>
                        @endforeach
                    </div>
                </div>
            @endforeach
        @else
            <div class="px-2 py-5 text-center">Нет доступных сеансов на <b>{{ $filter_date }}</b></div>
            <br />
        @endif
    </div>



    <br /><br />
    <a class="btn btn-primary shadow" href="{{ route('public.cinemas.index') }}" role="button">
        @lang('public.go_back')
    </a>
@endsection

@section('pageContentRight')
    <div id="mapElement" class="map-element"></div>
    <br /><br />
    <p><b>Фотогалерея</b></p>
    @if (count($cinema['photos_thumb_url']) > 0)
        @foreach ($cinema['photos_thumb_url'] as $i => $photos_thumb_url)
            <div class="mr-3 my-2">
                <a class="shadow" href="{{ $cinema['photos_url'][$i] }}" target="_blank">
                    <img src="{{ $photos_thumb_url }}" alt="" style="max-width:100%;height:auto;" />
                </a>
            </div>
        @endforeach
    @endif
    @if(strlen($cinema['description']) > 0)
        <br /><br />
        <p><b>О кинотеатре</b></p>
        <div class="text-dark p-3" style="background-color: #f2f2f2;">
            {!! $cinema['description'] !!}
        </div>
    @endif
@endsection
