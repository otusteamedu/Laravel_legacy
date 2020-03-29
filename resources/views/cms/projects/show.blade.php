@extends('plain.layout')

@section('header-styles')
    @include('plain.blocks.header-styles')
@endsection

@section('header-scripts')
    @include('plain.blocks.header-scripts')
@endsection

@section('title')
    Список проектов пользователей
@endsection

@section('content')
    <header>
        @include('plain.blocks.header')
    </header>

    <main>
        <div class="wrapper">
            <div class="header">
                <h1>Список проектов пользователей</h1>
                @include('plain.blocks.header-sub')
            </div>

            <div class="content">
                @include('cms.projects.blocks.header.list', ['project' => $project])
                @include('cms.projects.blocks.list.index', ['project' => $project])
            </div>

        </div>
    </main>

    <footer>
        @include('plain.blocks.footer')
    </footer>


@endsection
