@extends('layouts.site1')
@section('content')
    <div class="container">
        <h1>{{$detail->name}}</h1>
        <hr>
        <h2>Грамматика</h2>
        {!! $detail->grammar_text !!}
        <hr>
        <h2>Арабский текст</h2>
        <div class="h2 text-right">
            {!! $detail->arabic_text !!}
        </div>
    </div>
@endsection
