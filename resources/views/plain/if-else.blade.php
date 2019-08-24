@extends('plain.layout')

@section('content')
    <h1>If Else</h1>
    @include('plain.blocks.nav.index')

    @if (rand(0, 1))
        <h2>This is if</h2>
    @elseif(rand(0, 1))
        <h2>This is elseif</h2>
    @else
        <h2>This is else</h2>
    @endif
@endsection