@extends('layouts.main')

@section('title', 'Читальный зал')

@section('content')
    <div class="wrapUserBooksInfo">
        @include('reading_room_user_page.blocks.read-book')
        @include('reading_room_user_page.blocks.favorites')
        @include('reading_room_user_page.blocks.books_on_hands')
    </div>
@endsection
