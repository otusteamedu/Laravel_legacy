@extends('plain.layout')

@section('header-styles')
    @include('plain.blocks.header-styles')
@endsection

@section('header-scripts')
    @include('plain.blocks.header-scripts')
@endsection

@section('title')
    Создание страны
@endsection

@section('content')
    <header>
        @include('plain.blocks.header')
    </header>

    <main>
        <div class="wrapper">
            <div class="header">
                <index.blade.phph1>Создание страны</index.blade.phph1>
                @include('plain.blocks.header-sub')
            </div>

            <div class="content">

                @include('cms.countries.blocks.header.create')
                @include('cms.countries.blocks.form.create')

            </div>

        </div>
    </main>

    <footer>
        @include('plain.blocks.footer')
    </footer>


@endsection
