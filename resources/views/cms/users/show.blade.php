@extends('plain.layout')

@section('header-styles')
    @include('plain.blocks.header-styles')
@endsection

@section('header-scripts')
    @include('plain.blocks.header-scripts')
@endsection

@section('title')
    Список пользователей
@endsection

@section('content')
    <header>
        @include('plain.blocks.header')
    </header>

    <main>
        <div class="wrapper">
            <div class="header">
                <h1>Список пользователей</h1>
                @include('plain.blocks.header-sub')
            </div>

            <div class="content">
                @include('cms.users.blocks.header.list', ['user' => $user])
                @include('cms.users.blocks.list.index', ['user' => $user])
            </div>

        </div>
    </main>

    <footer>
        @include('plain.blocks.footer')
    </footer>


@endsection
