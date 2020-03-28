@extends('plain.layout')

@section('header-styles')
    @include('plain.blocks.header-styles')
@endsection

@section('header-scripts')
    @include('plain.blocks.header-scripts')
@endsection

@section('title')
    Список тарифов пользователей
@endsection

@section('content')
    <header>
        @include('plain.blocks.header')
    </header>

    <main>
        <div class="wrapper">
            <div class="header">
                <h1>Список тарифов пользователей</h1>
                @include('plain.blocks.header-sub')
            </div>

            <div class="content">
                @include('cms.tariffs.blocks.header.list', ['tariff' => $tariff])
                @include('cms.tariffs.blocks.list.index', ['tariff' => $tariff])
            </div>

        </div>
    </main>

    <footer>
        @include('plain.blocks.footer')
    </footer>


@endsection
