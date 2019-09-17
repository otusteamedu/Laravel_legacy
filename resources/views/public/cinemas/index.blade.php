@extends('public.cinemas.layout')

@section('pageTitle')
    Кинотеатры сети
@endsection

@section('pageHeader')
    Кинотеатры сети
@endsection

@section('pageContentMain')
    <div id="mapElement" class="map-element" style="max-width: 400px;"></div>
    @if (count($cinemasList) > 0)
        <div class="container-fluid cinemas-list i-iblock">
            @foreach ($cinemasList as $item)
                <div class="row align-items-start">
                    <div class="col-3 image p-0">
                        <a title="{{ $item['NAME'] }}" href="{{ route('public.cinemas.item', ['id' => $item['ID']]) }}" style="background-image: url({{ asset($item['PICTURE']) }})"></a>
                    </div>
                    <div class="col-9 desc">
                        <div class="name">
                            <a href="{{ route('public.cinemas.item', ['id' => $item['ID']]) }}">{{ $item['NAME'] }}</a>
                        </div>
                        <div class="text">
                            {{ $item['ADDRESS'] }}
                        </div>
                        <a class="btn btn-primary shadow" href="{{ route('public.cinemas.item', ['id' => $item['ID']]) }}" role="button">Подробнее</a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection

@section('pageContentRight')
@endsection
