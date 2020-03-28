@extends('plain.layout')

@section('header-styles')
    @include('plain.blocks.header-styles')
@endsection

@section('header-scripts')
    @include('plain.blocks.header-scripts')
@endsection

@section('title')
    Список категорий товарных предложений
@endsection

@section('content')
    <header>
        @include('plain.blocks.header')
    </header>

    <main>
        <div class="wrapper">
            <div class="header">
                <h1>Список категорий товарных предложений</h1>
                @include('plain.blocks.header-sub')
            </div>

            <div class="content">
                @include('cms.categories.blocks.header.list', ['category' => $category])
                @include('cms.categories.blocks.list.index', ['category' => $category])
            </div>

        </div>
    </main>

    <footer>
        @include('plain.blocks.footer')
    </footer>


@endsection
