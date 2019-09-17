@extends('public.movies.layout')

@section('pageTitle')
    {{ $movie['name'] }}: заказ билета
@endsection

@section('pageHeader')
    {{ $movie['name'] }}: заказ билета
@endsection

@section('pageContentMain')
    @if (count($movieShowing) > 0)
        <div class="i-title"><span class="">Купить билет</span></div>
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
                                    <a title="{{ $item['cinema']['NAME'] }}" href="{{ route('public.cinemas.item', ['id' => $item['cinema']['ID']]) }}" style="background-image: url({{ asset($item['cinema']['PICTURE']) }})"></a>
                                </div>
                                <div class="col-8 col-md-10 desc">
                                    <div class="name">
                                        <a href="{{ route('public.cinemas.item', ['id' => $item['cinema']['ID']]) }}">{{ $item['cinema']['NAME'] }}</a>
                                    </div>
                                    <div class="text">
                                        {{ $item['cinema']['ADDRESS'] }}
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
    <br /><br />
    <div class="container-fluid">
        <a class="btn btn-primary shadow" href="{{ route('public.movies.info', ['id' => $movie['id']]) }}" role="button">
            О фильме
        </a>
        <a class="btn btn-primary shadow" href="{{ route('public.movies.showing') }}" role="button">
            Вернуться
        </a>
    </div>
    @include('public.elements.filter')
@endsection
