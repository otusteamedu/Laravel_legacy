@extends('layouts.site1')
@section('content')
    <h1 class="text-center">{{$detail->name}}</h1>
    <hr>
    <h2 class="text-center">Написание</h2>
    <div class="row text-center">
        <div class="col-sm-12 display-1">{{$detail->harf_name}}</div>
    </div>
    <h3 class="text-center">Начертание букв при соединении с</h3>
    <div class="row text-center">
        <div class="col-sm-12 display-1">{{$detail->harf_free}}</div>
    </div>
    <div class="row text-center">
        <div class="col-sm-4">
            <div>предыдущей</div>
            <div class="display-1">{{$detail->harf_first}}</div>
        </div>
        <div class="col-sm-4">
            <div>двух сторон</div>
            <div class="display-1">{{$detail->harf_center}}</div>
        </div>
        <div class="col-sm-4">
            <div>последующей</div>
            <div class="display-1">{{$detail->harf_last}}</div>
        </div>
    </div>
    <div class="row">
        <h2 class="text-center">Произношение</h2>
        <div class="col-sm-12">{!!$detail->text_about!!}</div>
    </div>
    <div class="row text-center">
        <h2 class="text-center">Для чтения</h2>
        <div class="col-sm-12 display-4">{!!$detail->text_for_reading!!}</div>

    </div>
@endsection
