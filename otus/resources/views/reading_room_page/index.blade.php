@extends('layouts.main')

@section('title', 'Читальный зал')

@section('content')
    @include('reading_room_page.blocks.content-header')
    @include('reading_room_page.blocks.user-list')
@endsection
