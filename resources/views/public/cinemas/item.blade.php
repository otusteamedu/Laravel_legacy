@extends('public.movies.layout')

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
    Кинотеатр &laquo;{{ $cinema['NAME'] }}&raquo;
@endsection

@section('pageContentMain')
    <ul class="properties">
        <li>
            <span class="p-name">Адрес:</span>
            <span class="p-value">
                {{ $cinema['ADDRESS'] }}
            </span>
        </li>
    </ul>

    <div class="container-fluid cinema-detail i-iblock">

    </div>
    @if (count($movieShowing) > 0)
        <div class="container-fluid movie-showing-list i-iblock">
            <div class="row align-items-start m-0">
                <div class="col-md-6 cinema p-0 py-3">
                </div>
                <div class="col-md-6 cinema p-0 py-3">
                    <form action="" method="get" class="">
                        <div class="i-content container-fluid">
                            <div class="row">
                                <label for="datetimepicker2" class="col-sm-5 col-form-label">Выбрать дату</label>
                                <div class="form-group col-sm-7">
                                    <div class="input-group date shadow" id="datetimepicker2" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker2" placeholder="Дата" value="{{ (new Datetime("now"))->format("d.m.Y") }}"/>
                                        <div class="input-group-append" data-target="#datetimepicker2" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            @foreach ($movieShowing as $item)
                <div class="row align-items-start m-0">
                    <div class="col-md-6 cinema p-0 py-3">
                        <div class="container-fluid cinema-item i-iblock p-0">
                            <div class="row align-items-start">
                                <div class="col-4 col-md-2 image p-0">
                                    <a title="{{ $item['movie']['name'] }}" href="{{ route('public.cinemas.item', ['id' => $item['movie']['id']]) }}" style="background-image: url({{ asset($item['movie']['poster']) }})"></a>
                                </div>
                                <div class="col-8 col-md-10 desc">
                                    <div class="name">
                                        <a href="{{ route('public.movies.info', ['id' => $item['movie']['id']]) }}">{{ $item['movie']['name'] }}</a>
                                    </div>
                                    <div class="text">
                                        {{ $item['movie']['slogan'] }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 showings desc p-0 py-3">
                        @foreach ($item['showings'] as $showing)
                            <a class="btn btn-warning shadow mb-2" href="#" role="button">
                                {{ $showing['date']->format('H:i') }}
                            </a>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection
