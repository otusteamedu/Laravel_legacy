@extends('layouts.app')

@section('content')
    <h1>{{ $repository }}</h1>
    @include('results.phpinsights.summary')
@endsection
