@extends('public.page')

@section('metaTitle', 'Index-page')
@section('metaDescription', 'Index-desc')

@section('contentWrap')
    @include('public.index.slider')
    @include('public.index.content')
@endsection