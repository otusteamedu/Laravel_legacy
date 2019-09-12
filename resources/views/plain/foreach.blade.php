@extends('plain.layout')

@section('content')
    <h1>Foreach</h1>
    @include('plain.blocks.nav.index')

    @php($newsList = [
        'Worlds fastest man Coleman investigated over three alleged missed drugs tests',
        'Williams to face Sharapova in first round of US Open',
        'Serena Williams and Maria Sharapova before the 2015 Australian Open final',
        '3habout 3 hours agoFrom the section Cricket'
    ])

    <h2>News: </h2>
    <ul>
        @csrf
        @foreach($newsList as $news)
            <li>
                @if ($loop->first) Breaking News: @endif
                @if ($loop->last) Last News: @endif
                {{ $news }}
            </li>
        @endforeach
    </ul>
@endsection

