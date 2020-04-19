@extends('plain.layout')

@section('header-styles')
    @include('plain.blocks.header-styles')
@endsection

@section('header-scripts')
    @include('plain.blocks.header-scripts')
@endsection

@section('title')
    Редактирование тарифа
@endsection

@section('content')
    <header>
        @include('plain.blocks.header')
    </header>

    <main>
        <div class="wrapper">
            <div class="header">
                <h1>Редактирование тарифа</h1>
                @include('plain.blocks.header-sub')
            </div>

            <div class="content">
                @include('cms.tariffs.blocks.header.edit')
                @include('cms.tariffs.blocks.form.edit', ['tariff' => $tariff])
            </div>

        </div>
    </main>

    <footer>
        @include('plain.blocks.footer')
    </footer>


@endsection
