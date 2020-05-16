<!--Страница просмотра новости-->
@extends('layouts.app')
@section('header')
    <header class="blog-header py-3">
        @include('blocks.header.header')
    </header>
@endsection
@section('content')
    @include('blocks.navbars.categories')
    <main role="main" class="container pt-3">
        <div class="row">
            @include('blocks.content.article')
            @include('blocks.sidebars.main')
        </div>
        <div class="row">
            @include('components.comments')
        </div>
    </main>
@endsection
@section('footer')
    <footer class="blog-footer border-top pt-3">
        @include('blocks.footer.footer')
    </footer>
@endsection
