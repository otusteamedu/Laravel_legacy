@extends('plain.layout')

@section('header-styles')
    @include('plain.blocks.header-styles')
@endsection

@section('header-scripts')
    @include('plain.blocks.header-scripts')
@endsection

@section('title')
    Список сегментов пользователей
@endsection

@section('content')
    <header>
        @include('plain.blocks.header')
    </header>

    <main>
        <div class="wrapper">
            <div class="header">
                <h1>Список сегментов пользователей</h1>
                @include('plain.blocks.header-sub')
            </div>

            <div class="content">
                @include('cms.segments.blocks.header.list', ['segment' => $segment])
                @include('cms.segments.blocks.list.index', ['segment' => $segment])
            </div>

        </div>
    </main>

    <footer>
        @include('plain.blocks.footer')
    </footer>


@endsection
