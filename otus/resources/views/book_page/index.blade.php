@extends('layouts.main')

@section('title', 'Страница книги ')

@section('content')
<div class="container bookPage">
    <div class="leftSide">
        @include('book_page.blocks.wrap-img-block')
        @include('book_page.blocks.option-block')
        @include('book_page.blocks.info-block')
    </div>
    <div class="rightSide">
        <div class="downloadBook">
            @include('book_page.blocks.title-and-tags')
            @include('book_page.blocks.author')
            @include('book_page.blocks.category')
            @include('book_page.blocks.download-link')
        </div>
       @include('book_page.blocks.about-book')
    </div>
</div>
@endsection
