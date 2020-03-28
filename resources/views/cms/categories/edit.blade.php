@extends('plain.layout')

@section('header-styles')
    @include('plain.blocks.header-styles')
@endsection

@section('header-scripts')
    @include('plain.blocks.header-scripts')
@endsection

@section('title')
    Редактирование категории
@endsection

@section('content')
    <header>
        @include('plain.blocks.header')
    </header>

    <main>
        <div class="wrapper">
            <div class="header">
                <h1>Редактирование категории</h1>
                @include('plain.blocks.header-sub')
            </div>

            <div class="content">
                @include('cms.categories.blocks.header.edit')
                @include('cms.categories.blocks.form.edit')
            </div>

        </div>
    </main>

    <footer>
        @include('plain.blocks.footer')
    </footer>


@endsection
