@extends('plain.layout')

@section('header-styles')
    @include('plain.blocks.header-styles')
@endsection

@section('header-scripts')
    @include('plain.blocks.header-scripts')
@endsection

@section('title')
    Список городов
@endsection

@section('content')
    <header>
        @include('plain.blocks.header')
    </header>

    <main>
        <div class="wrapper">
            <div class="header">
                <h1>Список городов</h1>
                @include('plain.blocks.header-sub-cms')
            </div>

            <div class="content">
                @include('cms.cities.blocks.list.index')
            </div>
        </div>
    </main>

    <footer>
        @include('plain.blocks.footer')
    </footer>

@endsection
