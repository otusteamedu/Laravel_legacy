@extends('layouts.index')
@section('sidebar')
    @include('blocks.sidebar.recipes.filters.index')
    @include('blocks.sidebar.recipes.popular')
@endsection
