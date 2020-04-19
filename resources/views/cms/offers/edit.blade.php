@extends('plain.layout')

@section('header-styles')
    @include('plain.blocks.header-styles')
@endsection

@section('header-scripts')
    @include('plain.blocks.header-scripts')
@endsection

@section('title')
    Редактирование предложения (акции)
@endsection

@section('content')
    <header>
        @include('plain.blocks.header')
    </header>

    <main>
        <div class="wrapper">
            <div class="header">
                <h1>Редактирование предложения (акции)</h1>
                @include('plain.blocks.header-sub')
            </div>

            <div class="content">
                @include('cms.offers.blocks.header.edit')
                @include('cms.offers.blocks.form.edit', ['offer' => $offer])
            </div>

        </div>
    </main>

    <footer>
        @include('plain.blocks.footer')
    </footer>


@endsection
