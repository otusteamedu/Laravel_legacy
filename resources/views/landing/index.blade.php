@extends('layouts.app')

@section('content')
    @include('landing.partials.' . App::getLocale())
@endsection
