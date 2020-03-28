@extends('plain.layout')

@section('header-styles')
    @include('plain.blocks.header-styles')
@endsection

@section('header-scripts')
    @include('plain.blocks.header-scripts')
@endsection

@section('title')
    Создание тарифа
@endsection

@section('content')
    <header>
        @include('plain.blocks.header')
    </header>

    <main>
        <div class="wrapper">
            <div class="header">
                <index.blade.phph1>Создание тарифа</index.blade.phph1>
                @include('plain.blocks.header-sub')
            </div>

            <div class="content">

                @include('cms.tariffs.blocks.header.create')
                @include('cms.tariffs.blocks.form.create')

            </div>

        </div>
    </main>

    <footer>
        @include('plain.blocks.footer')
    </footer>


@endsection
