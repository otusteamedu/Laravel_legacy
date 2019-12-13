@extends('layouts.app')

@section('content')
    <div class="alert alert-danger" role="alert">
        {{ $error }}
    </div>

    @include('landing.partials.try_form')
@endsection
