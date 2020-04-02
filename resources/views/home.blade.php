@extends('plain.layout')

@section('header-styles')
    @include('plain.blocks.header-styles')
@endsection

@section('header-scripts')
    @include('plain.blocks.header-scripts')
@endsection

@section('title')
    Авторизация
@endsection

@section('content')
    <header>
        @include('plain.blocks.header')
    </header>

    <main>
        <div class="wrapper">
            <div class="header">
                <h1>Авторизация</h1>
                @include('plain.blocks.header-sub')
            </div>

            <div class="content">
                Вы успешло авторизованы
            </div>
        </div>

        <footer>
            @include('plain.blocks.footer')
        </footer>

@endsection
