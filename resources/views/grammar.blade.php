@extends('layouts.site1')
@section('content')
    <div class="container">
        <h1>{{$detail->getName()}}</h1>
        <hr>
        <h2>Грамматика</h2>
        {!! $detail->getGrammarText() !!}
        <hr>
        <h2>Арабский текст</h2>
        <div class="h2 text-right">
            {!! $detail->getArabicText() !!}
        </div>
    </div>
@endsection
