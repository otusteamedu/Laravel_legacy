@extends('layouts.app')

@section('header')
    @include('blocks.header.header')
@endsection

@section('content')
    @include('films.blocks.list.index')
@endsection
