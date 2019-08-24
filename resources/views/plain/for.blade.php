@extends('plain.layout')

@section('content')
    <h1>For</h1>
    @include('plain.blocks.nav.index')

    @for($i = 0; $i < 10; $i++)
        <p>
            @for($j = 0; $j < 10; $j++)
                <span>
                    {{ $i }}{{ $j }}
                </span>
            @endfor
        </p>
    @endfor
@endsection