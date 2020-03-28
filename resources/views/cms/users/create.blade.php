@extends('plain.layout')

@section('header-styles')
    @include('plain.blocks.header-styles')
@endsection

@section('header-scripts')
    @include('plain.blocks.header-scripts')
@endsection

@section('title')
    Создание пользователей
@endsection

@section('content')
    <header>
        @include('plain.blocks.header')
    </header>

    <main>
        <div class="wrapper">
            <div class="header">
                <index.blade.phph1>Создание пользователей</index.blade.phph1>
                @include('plain.blocks.header-sub')
            </div>

            <div class="content">

                @include('cms.users.blocks.header.create')
                @include('cms.users.blocks.form.create')

            </div>

        </div>
    </main>

    <footer>
        @include('plain.blocks.footer')
    </footer>


@endsection
