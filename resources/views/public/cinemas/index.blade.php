@extends('public.cinemas.layout')

@section('pageTitle')
    Кинотеатры сети
@endsection

@php
    $breadCrumbs = [
        [
            'url' => \route('public.start'),
            'title' => __('public.menu.home')
        ],  [
            'url' => \route('public.cinemas.index'),
            'title' => __('public.menu.cinemas')
        ]
    ]
@endphp

@section('pageHeader')
    Кинотеатры сети
@endsection

@section('pageContentMain')
    <div id="mapElement" class="map-element"></div>
    @if (count($cinemasList) > 0)
        <div class="container-fluid cinemas-list i-iblock">
            @foreach ($cinemasList as $item)
                <div class="row align-items-start">
                    <div class="col-3 image p-0">
                        <a title="{{ $item['name'] }}" href="{{ route('public.cinemas.item', ['id' => $item['id']]) }}" style="background-image: url({{ asset($item['photo_thumb_url']) }})"></a>
                    </div>
                    <div class="col-9 desc">
                        <div class="name">
                            <a href="{{ route('public.cinemas.item', ['id' => $item['id']]) }}">{{ $item['name'] }}</a>
                        </div>
                        <div class="text">
                            {{ $item['address'] }}
                        </div>
                        <a class="btn btn-primary shadow" href="{{ route('public.cinemas.item', ['id' => $item['id']]) }}" role="button">Подробнее</a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection

@section('pageContentRight')
@endsection
