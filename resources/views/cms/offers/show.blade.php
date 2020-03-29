@extends('plain.layout')

@section('header-styles')
    @include('plain.blocks.header-styles')
@endsection

@section('header-scripts')
    @include('plain.blocks.header-scripts')
@endsection

@section('title')
    Список предложений (акций)
@endsection

@section('content')
    <header>
        @include('plain.blocks.header')
    </header>

    <main>
        <div class="wrapper">
            <div class="header">
                <h1>Список предложений (акций)</h1>
                @include('plain.blocks.header-sub')
            </div>

            <div class="content">
                @include('cms.offers.blocks.header.list', ['offer' => $offer])
                @include('cms.offers.blocks.list.index', ['offer' => $offer])
            </div>

        </div>
    </main>

    <footer>
        @include('plain.blocks.footer')
    </footer>


@endsection
